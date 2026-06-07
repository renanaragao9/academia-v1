interface WorkoutLogStudentPayload {
  code: string;
  email?: string;
  phone?: string;
}

interface WorkoutLogExercisePayload {
  exerciseId: number;
  exerciseName: string;
  performedSeries: number | null;
  performedRepetitions: string | null;
  performedLoad: number | null;
  completed: boolean;
  observation: string | null;
}

interface StartWorkoutLogPayload {
  student: WorkoutLogStudentPayload;
  trainingSheetId: number;
  trainingSheetDivisionId: number;
  exercises: Array<{
    exerciseId: number;
    exerciseName: string;
    defaultSeries: number | null;
    defaultRepetitions: string | null;
    defaultLoad: number | null;
  }>;
}

interface SubmitWorkoutLogOptions {
  apiBase: string;
  finishedAt?: string;
  durationMinutes?: number | null;
}

export const useWorkoutLogsStore = defineStore("workoutLogs", () => {
  const startedAt = ref<string | null>(null);
  const trainingSheetId = ref<number | null>(null);
  const trainingSheetDivisionId = ref<number | null>(null);
  const student = ref<WorkoutLogStudentPayload | null>(null);
  const exercises = ref<WorkoutLogExercisePayload[]>([]);
  const isSubmitting = ref(false);

  const hasSession = computed(
    () =>
      !!startedAt.value &&
      !!trainingSheetId.value &&
      !!trainingSheetDivisionId.value,
  );

  function startSession(payload: StartWorkoutLogPayload): void {
    student.value = payload.student;
    trainingSheetId.value = payload.trainingSheetId;
    trainingSheetDivisionId.value = payload.trainingSheetDivisionId;
    startedAt.value = new Date().toISOString().slice(0, 19).replace("T", " ");

    exercises.value = payload.exercises.map((exercise) => ({
      exerciseId: exercise.exerciseId,
      exerciseName: exercise.exerciseName,
      performedSeries: exercise.defaultSeries,
      performedRepetitions: exercise.defaultRepetitions,
      performedLoad: exercise.defaultLoad,
      completed: false,
      observation: null,
    }));
  }

  function clearSession(): void {
    startedAt.value = null;
    trainingSheetId.value = null;
    trainingSheetDivisionId.value = null;
    student.value = null;
    exercises.value = [];
  }

  async function submitSession(
    options: SubmitWorkoutLogOptions,
  ): Promise<Record<string, unknown>> {
    if (
      !student.value ||
      !startedAt.value ||
      !trainingSheetId.value ||
      !trainingSheetDivisionId.value
    ) {
      throw new Error("Sessao de treino invalida.");
    }

    isSubmitting.value = true;

    try {
      const finishedAt =
        options.finishedAt ??
        new Date().toISOString().slice(0, 19).replace("T", " ");
      const response = await $fetch<{ data: Record<string, unknown> }>(
        `${options.apiBase}/v1/workout_logs`,
        {
          method: "POST",
          body: {
            code: student.value.code,
            email: student.value.email,
            phone: student.value.phone,
            training_sheet_id: trainingSheetId.value,
            training_sheet_division_id: trainingSheetDivisionId.value,
            started_at: startedAt.value,
            finished_at: finishedAt,
            duration_minutes: options.durationMinutes ?? null,
            exercises: exercises.value.map((exercise) => ({
              exercise_id: exercise.exerciseId,
              performed_series: exercise.performedSeries,
              performed_repetitions: exercise.performedRepetitions,
              performed_load: exercise.performedLoad,
              completed: exercise.completed,
              observation: exercise.observation,
            })),
          },
        },
      );

      clearSession();

      return response.data;
    } finally {
      isSubmitting.value = false;
    }
  }

  return {
    startedAt,
    trainingSheetId,
    trainingSheetDivisionId,
    student,
    exercises,
    isSubmitting,
    hasSession,
    startSession,
    clearSession,
    submitSession,
  };
});
