<script setup lang="ts">
interface Student {
  id: number;
  name: string;
  code: string;
  email?: string;
  phone?: string;
}

interface MeasurementType {
  id: number;
  name: string;
}

interface Assessment {
  id: number;
  value: string;
  assessedAt: string;
  notes: string | null;
  measurementType: MeasurementType;
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

const assessments = ref<Assessment[]>([]);
const isLoading = ref(true);
const error = ref<string | null>(null);

onMounted(async () => {
  const storedStudent = localStorage.getItem("student");
  if (!storedStudent) {
    navigateTo("/login");
    return;
  }

  const student = JSON.parse(storedStudent) as Student;

  try {
    const response = await $fetch<ApiResponse>(`${apiBase}/v1/assessments`, {
      method: "POST",
      body: {
        code: student.code,
        email: student.email ?? undefined,
        phone: student.phone ?? undefined,
      },
    });

    const raw = response.data ?? [];
    assessments.value = raw.map(
      (item) =>
        convertKeysToCamel(
          item as Record<string, unknown>,
        ) as unknown as Assessment,
    );
  } catch (e) {
    error.value = "Não foi possível carregar as avaliações.";
    console.error(e);
  } finally {
    isLoading.value = false;
  }
});

function formatDate(dateStr: string | null): string {
  if (!dateStr) return "-";
  const [year, month, day] = dateStr.split("-");
  return `${day}/${month}/${year}`;
}

const grouped = computed(() => {
  const map = new Map<string, Assessment[]>();
  for (const a of assessments.value) {
    const key = a.measurementType.name;
    if (!map.has(key)) map.set(key, []);
    map.get(key)!.push(a);
  }
  return Array.from(map.entries()).map(([name, items]) => ({
    name,
    latest: items[0]!,
    history: items,
  }));
});

const expandedGroups = ref<Set<string>>(new Set());

function toggleGroup(name: string) {
  if (expandedGroups.value.has(name)) {
    expandedGroups.value.delete(name);
  } else {
    expandedGroups.value.add(name);
  }
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
          <h1 class="text-2xl sm:text-3xl font-bold text-white">Avaliações</h1>
          <p class="text-sm sm:text-base text-zinc-400">
            Acompanhe seu progresso e evolução
          </p>
        </div>
      </div>

      <div v-if="isLoading" class="card-default text-center py-20">
        <Icon
          name="lucide:loader-2"
          class="h-12 w-12 text-blue-500 mx-auto mb-4 animate-spin"
        />
        <p class="text-zinc-400">Carregando avaliações...</p>
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
        v-else-if="grouped.length === 0"
        class="card-default text-center py-20"
      >
        <Icon
          name="lucide:activity"
          class="h-16 w-16 text-blue-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">
          Nenhuma avaliação encontrada
        </h2>
        <p class="text-zinc-400">
          Você ainda não possui avaliações registradas.
        </p>
      </div>

      <div
        v-else
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4"
      >
        <div
          v-for="group in grouped"
          :key="group.name"
          class="card-default overflow-hidden"
        >
          <div
            class="px-5 py-4 border-b border-zinc-700/60 flex items-center gap-3"
          >
            <div
              class="h-9 w-9 rounded-full bg-blue-500/10 border border-blue-500/30 flex items-center justify-center flex-shrink-0"
            >
              <Icon name="lucide:activity" class="h-4 w-4 text-blue-400" />
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-white font-semibold truncate">{{ group.name }}</p>
              <p class="text-xs text-zinc-400">
                {{ group.history.length }}
                {{ group.history.length === 1 ? "registro" : "registros" }}
              </p>
            </div>
          </div>

          <div class="px-4 sm:px-5 py-5 flex items-end justify-between gap-2">
            <div>
              <p class="text-xs text-zinc-400 mb-1">Último valor</p>
              <p class="text-2xl sm:text-3xl font-bold text-white">
                {{ group.latest.value }}
              </p>
              <p class="text-xs text-zinc-400 mt-1">
                {{ formatDate(group.latest.assessedAt) }}
              </p>
            </div>

            <template v-if="group.history.length > 1">
              <div
                :class="[
                  'flex items-center gap-1 text-sm font-semibold px-2.5 py-1 rounded-full',
                  Number(group.history[0]!.value) >
                  Number(group.history[1]!.value)
                    ? 'bg-green-500/10 text-green-400'
                    : Number(group.history[0]!.value) <
                        Number(group.history[1]!.value)
                      ? 'bg-red-500/10 text-red-400'
                      : 'bg-zinc-700 text-zinc-400',
                ]"
              >
                <Icon
                  :name="
                    Number(group.history[0]!.value) >
                    Number(group.history[1]!.value)
                      ? 'lucide:trending-up'
                      : Number(group.history[0]!.value) <
                          Number(group.history[1]!.value)
                        ? 'lucide:trending-down'
                        : 'lucide:minus'
                  "
                  class="h-4 w-4"
                />
                {{
                  Math.abs(
                    Number(group.history[0]!.value) -
                      Number(group.history[1]!.value),
                  ).toFixed(2)
                }}
              </div>
            </template>
          </div>

          <div
            v-if="group.history.length > 1"
            class="border-t border-zinc-700/60"
          >
            <button
              class="w-full px-5 py-3 flex items-center justify-between text-xs text-zinc-400 hover:text-white transition-colors"
              @click="toggleGroup(group.name)"
            >
              <span>Ver histórico</span>
              <Icon
                :name="
                  expandedGroups.has(group.name)
                    ? 'lucide:chevron-up'
                    : 'lucide:chevron-down'
                "
                class="h-4 w-4"
              />
            </button>

            <div v-if="expandedGroups.has(group.name)" class="pb-2">
              <div
                v-for="(item, index) in group.history"
                :key="item.id"
                :class="[
                  'flex items-center justify-between px-5 py-2 text-sm',
                  index === 0 ? 'text-white font-medium' : 'text-zinc-400',
                ]"
              >
                <span>{{ formatDate(item.assessedAt) }}</span>
                <span>{{ item.value }}</span>
              </div>
            </div>
          </div>

          <div
            v-if="group.latest.notes"
            class="px-5 py-3 border-t border-zinc-700/60"
          >
            <p class="text-xs text-zinc-400 italic">{{ group.latest.notes }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
