<script setup lang="ts">
interface Student {
  id: number;
  name: string;
  code: string;
  email?: string;
  phone?: string;
}

interface Food {
  id: number;
  name: string;
}

interface MealPlanFood {
  id: number;
  order: number;
  quantity: string | null;
  unit: string | null;
  observation: string | null;
  food: Food;
}

interface MealType {
  id: number;
  name: string;
}

interface MealPlanMeal {
  id: number;
  order: number;
  mealType: MealType;
  foods: MealPlanFood[];
}

interface MealPlan {
  id: number;
  name: string;
  startDate: string | null;
  endDate: string | null;
  isActive: boolean;
  meals: MealPlanMeal[];
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

const mealPlans = ref<MealPlan[]>([]);
const isLoading = ref(true);
const error = ref<string | null>(null);
const activeMealPlanId = ref<number | null>(null);
const expandedMeals = ref<Set<number>>(new Set());

onMounted(async () => {
  const storedStudent = localStorage.getItem("student");
  if (!storedStudent) {
    navigateTo("/login");
    return;
  }

  const student = JSON.parse(storedStudent) as Student;

  try {
    const response = await $fetch<ApiResponse>(`${apiBase}/v1/meal_plans`, {
      method: "POST",
      body: {
        code: student.code,
        email: student.email ?? undefined,
        phone: student.phone ?? undefined,
      },
    });

    const raw = response.data ?? [];
    mealPlans.value = raw.map(
      (item) =>
        convertKeysToCamel(
          item as Record<string, unknown>,
        ) as unknown as MealPlan,
    );

    const first = mealPlans.value[0] ?? null;
    if (first) {
      activeMealPlanId.value = first.id;
      expandedMeals.value = new Set(first.meals.map((meal) => meal.id));
    }
  } catch (e) {
    error.value = "Nao foi possivel carregar os planos alimentares.";
    console.error(e);
  } finally {
    isLoading.value = false;
  }
});

const activeMealPlan = computed<MealPlan | null>(
  () =>
    mealPlans.value.find((plan) => plan.id === activeMealPlanId.value) ?? null,
);

function selectMealPlan(plan: MealPlan): void {
  activeMealPlanId.value = plan.id;
  expandedMeals.value = new Set(plan.meals.map((meal) => meal.id));
}

function toggleMeal(mealId: number): void {
  if (expandedMeals.value.has(mealId)) {
    expandedMeals.value.delete(mealId);
    return;
  }

  expandedMeals.value.add(mealId);
}

function formatDate(value: string | null): string {
  if (!value) {
    return "-";
  }

  const [year, month, day] = value.split("-");
  return `${day}/${month}/${year}`;
}

function foodPortion(food: MealPlanFood): string {
  if (!food.quantity && !food.unit) {
    return "Qtd. nao informada";
  }

  if (!food.quantity) {
    return food.unit ?? "Qtd. nao informada";
  }

  if (!food.unit) {
    return String(food.quantity);
  }

  return `${food.quantity} ${food.unit}`;
}
</script>

<template>
  <div class="min-h-screen bg-page-default">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
      <div class="flex items-center gap-4 mb-8">
        <NuxtLink
          to="/students"
          class="text-zinc-400 hover:text-white transition-colors"
        >
          <Icon name="lucide:arrow-left" class="h-6 w-6" />
        </NuxtLink>
        <div>
          <h1 class="text-2xl sm:text-3xl font-bold text-white">
            Plano Alimentar
          </h1>
          <p class="text-sm sm:text-base text-zinc-400">
            Seu plano nutricional personalizado
          </p>
        </div>
      </div>

      <div v-if="isLoading" class="card-default text-center py-20">
        <Icon
          name="lucide:loader-2"
          class="h-12 w-12 text-green-500 mx-auto mb-4 animate-spin"
        />
        <p class="text-zinc-400">Carregando planos alimentares...</p>
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
        v-else-if="mealPlans.length === 0"
        class="card-default text-center py-20"
      >
        <Icon
          name="lucide:utensils"
          class="h-16 w-16 text-green-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">
          Nenhum plano alimentar ativo
        </h2>
        <p class="text-zinc-400">
          Voce ainda nao possui plano alimentar ativo.
        </p>
      </div>

      <div v-else class="space-y-5 sm:space-y-6">
        <div
          v-if="mealPlans.length > 1"
          class="flex gap-3 overflow-x-auto pb-1 -mx-1 px-1 sm:flex-wrap sm:mx-0 sm:px-0"
        >
          <button
            v-for="plan in mealPlans"
            :key="plan.id"
            :class="[
              'flex-shrink-0 px-4 py-2 rounded-lg text-sm font-medium transition-colors border',
              activeMealPlanId === plan.id
                ? 'bg-green-500 border-green-500 text-white'
                : 'bg-zinc-800 border-zinc-700 text-zinc-300 hover:border-green-500 hover:text-white',
            ]"
            @click="selectMealPlan(plan)"
          >
            {{ plan.name }}
          </button>
        </div>

        <div v-if="activeMealPlan" class="card-default p-4 sm:p-6">
          <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
          >
            <div>
              <h2 class="text-2xl font-bold text-white">
                {{ activeMealPlan.name }}
              </h2>
              <div
                class="flex flex-wrap items-center gap-4 mt-1 text-sm text-zinc-400"
              >
                <span class="flex items-center gap-1">
                  <Icon name="lucide:calendar" class="h-4 w-4" />
                  {{ formatDate(activeMealPlan.startDate) }}
                  <template v-if="activeMealPlan.endDate">
                    - {{ formatDate(activeMealPlan.endDate) }}
                  </template>
                </span>
                <span class="flex items-center gap-1">
                  <Icon name="lucide:clock-3" class="h-4 w-4" />
                  {{ activeMealPlan.meals.length }}
                  {{
                    activeMealPlan.meals.length === 1 ? "refeicao" : "refeicoes"
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
              Ativo
            </span>
          </div>
        </div>

        <div v-if="activeMealPlan" class="space-y-4">
          <div
            v-for="meal in activeMealPlan.meals"
            :key="meal.id"
            class="card-default overflow-hidden"
          >
            <button
              class="w-full px-4 sm:px-6 py-4 flex items-center justify-between gap-3 text-left"
              @click="toggleMeal(meal.id)"
            >
              <div class="flex items-center gap-3 min-w-0">
                <div
                  class="h-9 w-9 rounded-full bg-green-500/10 border border-green-500/30 flex items-center justify-center flex-shrink-0 text-green-400 font-semibold text-sm"
                >
                  {{ meal.order }}
                </div>
                <div class="min-w-0">
                  <p class="text-white font-semibold truncate">
                    {{ meal.mealType.name }}
                  </p>
                  <p class="text-xs text-zinc-400">
                    {{ meal.foods.length }}
                    {{ meal.foods.length === 1 ? "alimento" : "alimentos" }}
                  </p>
                </div>
              </div>
              <Icon
                :name="
                  expandedMeals.has(meal.id)
                    ? 'lucide:chevron-up'
                    : 'lucide:chevron-down'
                "
                class="h-5 w-5 text-zinc-400"
              />
            </button>

            <div
              v-if="expandedMeals.has(meal.id)"
              class="border-t border-zinc-700/60"
            >
              <div
                v-for="food in meal.foods"
                :key="food.id"
                class="px-4 sm:px-6 py-4 border-b border-zinc-700/40 last:border-b-0"
              >
                <div class="flex items-start justify-between gap-4">
                  <div class="min-w-0">
                    <p class="text-white font-medium truncate">
                      {{ food.food.name }}
                    </p>
                    <p class="text-sm text-zinc-400">{{ foodPortion(food) }}</p>
                    <p
                      v-if="food.observation"
                      class="text-xs text-zinc-500 mt-1"
                    >
                      {{ food.observation }}
                    </p>
                  </div>
                  <span class="text-xs text-zinc-500">#{{ food.order }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
