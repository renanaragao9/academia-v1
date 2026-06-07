<script setup lang="ts">
interface Student {
  id: number;
  name: string;
  code: string;
  email?: string;
  phone?: string;
}

interface Exercise {
  id: number;
  name: string;
}

interface TrainingExercise {
  id: number;
  order: number;
  series: number;
  repetitions: string;
  restSeconds: number | null;
  load: string | null;
  observation: string | null;
  exercise: Exercise;
}

interface Division {
  id: number;
  name: string;
}

interface TrainingSheetDivision {
  id: number;
  order: number;
  division: Division;
  exercises: TrainingExercise[];
}

interface TrainingSheet {
  id: number;
  name: string;
  startDate: string | null;
  endDate: string | null;
  isActive: boolean;
  divisions: TrainingSheetDivision[];
}

interface ApiResponse {
  data: Record<string, unknown>[];
}

definePageMeta({
  middleware: ["auth"],
  layout: false,
});

const {
  public: { apiBase },
} = useRuntimeConfig();

const sheets = ref<TrainingSheet[]>([]);
const isLoading = ref(true);
const error = ref<string | null>(null);
const activeSheetId = ref<number | null>(null);
const activeDivisionId = ref<number | null>(null);

onMounted(async () => {
  const storedStudent = localStorage.getItem("student");
  if (!storedStudent) {
    navigateTo("/login");
    return;
  }

  const student = JSON.parse(storedStudent) as Student;

  try {
    const response = await $fetch<ApiResponse>(
      `${apiBase}/v1/training_sheets`,
      {
        method: "POST",
        body: {
          code: student.code,
          email: student.email ?? undefined,
          phone: student.phone ?? undefined,
        },
      },
    );

    const raw = response.data ?? [];
    sheets.value = raw.map(
      (item) =>
        convertKeysToCamel(
          item as Record<string, unknown>,
        ) as unknown as TrainingSheet,
    );

    const first = sheets.value[0] ?? null;
    if (first) {
      activeSheetId.value = first.id;
      activeDivisionId.value = first.divisions[0]?.id ?? null;
    }
  } catch (e) {
    error.value = "Não foi possível carregar as fichas de treino.";
    console.error(e);
  } finally {
    isLoading.value = false;
  }
});

const activeSheet = computed<TrainingSheet | null>(
  () => sheets.value.find((s) => s.id === activeSheetId.value) ?? null,
);

const activeDivision = computed<TrainingSheetDivision | null>(
  () =>
    activeSheet.value?.divisions.find((d) => d.id === activeDivisionId.value) ??
    null,
);

function selectSheet(sheet: TrainingSheet) {
  activeSheetId.value = sheet.id;
  activeDivisionId.value = sheet.divisions[0]?.id ?? null;
}

function formatDate(dateStr: string | null): string {
  if (!dateStr) return "-";
  const [year, month, day] = dateStr.split("-");
  return `${day}/${month}/${year}`;
}
</script>

<template>
  <div class="min-h-screen bg-page-default">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
      <!-- Header -->
      <div class="flex items-center gap-4 mb-8">
        <NuxtLink
          to="/students"
          class="text-zinc-400 hover:text-white transition-colors"
        >
          <Icon name="lucide:arrow-left" class="h-6 w-6" />
        </NuxtLink>
        <div>
          <h1 class="text-2xl sm:text-3xl font-bold text-white">
            Fichas de Treino
          </h1>
          <p class="text-sm sm:text-base text-zinc-400">
            Visualize e acompanhe seus treinos
          </p>
        </div>
      </div>

      <div v-if="isLoading" class="card-default text-center py-20">
        <Icon
          name="lucide:loader-2"
          class="h-12 w-12 text-orange-500 mx-auto mb-4 animate-spin"
        />
        <p class="text-zinc-400">Carregando fichas de treino...</p>
      </div>

      <div v-else-if="error" class="card-default text-center py-20">
        <Icon
          name="lucide:alert-circle"
          class="h-12 w-12 text-red-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">Erro ao carregar</h2>
        <p class="text-zinc-400">{{ error }}</p>
      </div>

      <div
        v-else-if="sheets.length === 0"
        class="card-default text-center py-20"
      >
        <Icon
          name="lucide:dumbbell"
          class="h-16 w-16 text-orange-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">Nenhuma ficha ativa</h2>
        <p class="text-zinc-400">
          Você ainda não possui fichas de treino ativas.
        </p>
      </div>

      <div v-else class="flex flex-col gap-5 sm:gap-6">
        <!-- Sheet selector (when more than one) -->
        <div
          v-if="sheets.length > 1"
          class="flex gap-3 overflow-x-auto pb-1 -mx-1 px-1 sm:flex-wrap sm:mx-0 sm:px-0"
        >
          <button
            v-for="sheet in sheets"
            :key="sheet.id"
            :class="[
              'flex-shrink-0 px-4 py-2 rounded-lg text-sm font-medium transition-colors border',
              activeSheetId === sheet.id
                ? 'bg-orange-500 border-orange-500 text-white'
                : 'bg-zinc-800 border-zinc-700 text-zinc-300 hover:border-orange-500 hover:text-white',
            ]"
            @click="selectSheet(sheet)"
          >
            {{ sheet.name }}
          </button>
        </div>

        <!-- Active sheet -->
        <div v-if="activeSheet" class="flex flex-col gap-6">
          <!-- Sheet info card -->
          <div class="card-default p-4 sm:p-6">
            <div
              class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
            >
              <div>
                <h2 class="text-2xl font-bold text-white">
                  {{ activeSheet.name }}
                </h2>
                <div
                  class="flex flex-wrap items-center gap-3 sm:gap-4 mt-1 text-sm text-zinc-400"
                >
                  <span
                    v-if="activeSheet.startDate"
                    class="flex items-center gap-1"
                  >
                    <Icon name="lucide:calendar" class="h-4 w-4" />
                    {{ formatDate(activeSheet.startDate) }}
                    <template v-if="activeSheet.endDate">
                      — {{ formatDate(activeSheet.endDate) }}
                    </template>
                  </span>
                  <span class="flex items-center gap-1">
                    <Icon name="lucide:layers" class="h-4 w-4" />
                    {{ activeSheet.divisions.length }}
                    {{
                      activeSheet.divisions.length === 1
                        ? "divisão"
                        : "divisões"
                    }}
                  </span>
                </div>
              </div>
              <span
                class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 self-start"
              >
                <span
                  class="h-1.5 w-1.5 rounded-full bg-green-400 inline-block"
                />
                Ativa
              </span>
            </div>
          </div>

          <!-- Division tabs -->
          <div v-if="activeSheet.divisions.length > 0">
            <div class="flex gap-2 overflow-x-auto pb-2 mb-4">
              <button
                v-for="div in activeSheet.divisions"
                :key="div.id"
                :class="[
                  'flex-shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors border',
                  activeDivisionId === div.id
                    ? 'bg-orange-500 border-orange-500 text-white'
                    : 'bg-zinc-800 border-zinc-700 text-zinc-300 hover:border-orange-500 hover:text-white',
                ]"
                @click="activeDivisionId = div.id"
              >
                <Icon name="lucide:dumbbell" class="h-4 w-4" />
                Treino {{ div.division.name }}
              </button>
            </div>

            <!-- Active division exercises -->
            <div v-if="activeDivision" class="card-default overflow-hidden">
              <div
                class="px-4 sm:px-6 py-4 border-b border-zinc-700/60 flex items-center justify-between"
              >
                <div>
                  <h3 class="text-base sm:text-lg font-bold text-white">
                    Treino {{ activeDivision.division.name }}
                  </h3>
                  <p class="text-sm text-zinc-400">
                    {{ activeDivision.exercises.length }}
                    {{
                      activeDivision.exercises.length === 1
                        ? "exercício"
                        : "exercícios"
                    }}
                  </p>
                </div>
                <Icon name="lucide:dumbbell" class="h-6 w-6 text-orange-500" />
              </div>

              <!-- Exercise list -->
              <div class="divide-y divide-zinc-700/60">
                <div
                  v-for="ex in activeDivision.exercises"
                  :key="ex.id"
                  class="px-4 sm:px-6 py-4 flex flex-col sm:flex-row sm:items-center gap-3"
                >
                  <!-- Order badge -->
                  <div
                    class="flex-shrink-0 h-8 w-8 rounded-full bg-orange-500/10 border border-orange-500/30 text-orange-400 text-sm font-bold flex items-center justify-center"
                  >
                    {{ ex.order }}
                  </div>

                  <!-- Exercise name -->
                  <div class="flex-1 min-w-0">
                    <p class="text-white font-semibold truncate">
                      {{ ex.exercise.name }}
                    </p>
                    <p
                      v-if="ex.observation"
                      class="text-xs text-zinc-400 mt-0.5"
                    >
                      {{ ex.observation }}
                    </p>
                  </div>

                  <!-- Stats -->
                  <div class="flex flex-wrap gap-2">
                    <span
                      class="inline-flex items-center gap-1 bg-zinc-700 text-zinc-200 text-xs font-medium px-2.5 py-1 rounded-md"
                    >
                      <Icon
                        name="lucide:repeat-2"
                        class="h-3 w-3 text-orange-400"
                      />
                      {{ ex.series }}x{{ ex.repetitions }}
                    </span>
                    <span
                      v-if="ex.restSeconds"
                      class="inline-flex items-center gap-1 bg-zinc-700 text-zinc-200 text-xs font-medium px-2.5 py-1 rounded-md"
                    >
                      <Icon name="lucide:timer" class="h-3 w-3 text-blue-400" />
                      {{ ex.restSeconds }}s
                    </span>
                    <span
                      v-if="ex.load"
                      class="inline-flex items-center gap-1 bg-zinc-700 text-zinc-200 text-xs font-medium px-2.5 py-1 rounded-md"
                    >
                      <Icon
                        name="lucide:weight"
                        class="h-3 w-3 text-green-400"
                      />
                      {{ ex.load }}kg
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
