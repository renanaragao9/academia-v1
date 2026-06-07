<script setup lang="ts">
interface Student {
  id: number;
  name: string;
  code: string;
  email?: string;
  phone?: string;
  image_path?: string;
  gender?: string;
  color?: string;
  status?: string;
  birth_date?: string;
  entry_date?: string;
  last_access_at?: string;
  weight?: number;
  height?: number;
  is_active?: boolean;
  user_id?: number;
}

interface ShortcutData {
  count: number;
  active?: Record<string, unknown>;
  latest?: Record<string, unknown>[];
}

interface DashboardShortcuts {
  training_sheets?: ShortcutData;
  assessments?: ShortcutData;
  meal_plans?: ShortcutData;
  monthly_fees?: ShortcutData;
  purchases?: ShortcutData;
}

interface DashboardData {
  student?: Student;
  shortcuts?: DashboardShortcuts;
}

interface ApiResponse {
  data: DashboardData;
  message: string;
}

interface CarouselSlide {
  gradient: string;
  title: string;
  subtitle: string;
}

interface WeekDay {
  name: string;
  short: string;
  value: number;
}

interface Shortcut {
  title: string;
  description: string;
  icon: string;
  route: string;
  count: number;
  color: string;
}

definePageMeta({
  middleware: ["auth"],
  layout: false,
});

const {
  public: { apiBase },
} = useRuntimeConfig();

const studentData = ref<Student | null>(null);
const dashboardData = ref<DashboardData | null>(null);
const isLoading = ref(true);
const currentImageIndex = ref(0);

const carouselImages = ref<CarouselSlide[]>([
  {
    gradient: "from-orange-600 via-red-600 to-orange-700",
    title: "Musculação",
    subtitle: "Equipamentos de última geração",
  },
  {
    gradient: "from-blue-600 via-cyan-600 to-blue-700",
    title: "Cardio",
    subtitle: "Mantenha seu coração saudável",
  },
  {
    gradient: "from-green-600 via-emerald-600 to-green-700",
    title: "Funcional",
    subtitle: "Treine movimentos do dia a dia",
  },
  {
    gradient: "from-purple-600 via-pink-600 to-purple-700",
    title: "Yoga & Pilates",
    subtitle: "Equilíbrio corpo e mente",
  },
]);

const weekDays: WeekDay[] = [
  { name: "Domingo", short: "Dom", value: 0 },
  { name: "Segunda-feira", short: "Seg", value: 1 },
  { name: "Terça-feira", short: "Ter", value: 2 },
  { name: "Quarta-feira", short: "Qua", value: 3 },
  { name: "Quinta-feira", short: "Qui", value: 4 },
  { name: "Sexta-feira", short: "Sex", value: 5 },
  { name: "Sábado", short: "Sáb", value: 6 },
];

const currentDay = new Date().getDay();

const shortcuts = computed<Shortcut[]>(() => [
  {
    title: "Fichas de Treino",
    description: "Visualize seus treinos",
    icon: "lucide:dumbbell",
    route: "/students/training-sheets",
    count: dashboardData.value?.shortcuts?.training_sheets?.count || 0,
    color: "orange",
  },
  {
    title: "Avaliações",
    description: "Acompanhe seu progresso",
    icon: "lucide:activity",
    route: "/students/assessments",
    count: dashboardData.value?.shortcuts?.assessments?.count || 0,
    color: "blue",
  },
  {
    title: "Plano Alimentar",
    description: "Seu plano nutricional",
    icon: "lucide:utensils",
    route: "/students/meal-plans",
    count: dashboardData.value?.shortcuts?.meal_plans?.count || 0,
    color: "green",
  },
  {
    title: "Mensalidades",
    description: "Consulte seus pagamentos",
    icon: "lucide:credit-card",
    route: "/students/monthly-fees",
    count: dashboardData.value?.shortcuts?.monthly_fees?.count || 0,
    color: "purple",
  },
  {
    title: "Compras",
    description: "Histórico de compras",
    icon: "lucide:shopping-bag",
    route: "/students/purchases",
    count: dashboardData.value?.shortcuts?.purchases?.count || 0,
    color: "pink",
  },
]);

onMounted(async () => {
  try {
    const storedStudent = localStorage.getItem("student");
    if (!storedStudent) {
      navigateTo("/login");
      return;
    }

    studentData.value = JSON.parse(storedStudent) as Student;

    const response = await $fetch<ApiResponse>(
      `${apiBase}/v1/students/${studentData.value?.id}/dashboard`,
    );

    if (response?.data) {
      dashboardData.value = response.data;
    }

    startCarousel();
  } catch (error) {
    console.error("Erro ao carregar dashboard:", error);
  } finally {
    isLoading.value = false;
  }
});

const startCarousel = () => {
  setInterval(() => {
    nextImage();
  }, 5000);
};

const nextImage = () => {
  currentImageIndex.value =
    (currentImageIndex.value + 1) % carouselImages.value.length;
};

const prevImage = () => {
  currentImageIndex.value =
    currentImageIndex.value === 0
      ? carouselImages.value.length - 1
      : currentImageIndex.value - 1;
};

const goToImage = (index: number) => {
  currentImageIndex.value = index;
};

const getGreeting = () => {
  const hour = new Date().getHours();
  if (hour < 12) return "Bom dia";
  if (hour < 18) return "Boa tarde";
  return "Boa noite";
};
</script>

<template>
  <div class="min-h-screen bg-page-default">
    <div v-if="isLoading" class="flex items-center justify-center min-h-screen">
      <Icon
        name="lucide:loader-2"
        class="h-12 w-12 text-orange-500 animate-spin"
      />
    </div>

    <div v-else class="max-w-7xl mx-auto px-4 sm:px-6 py-8 space-y-8">
      <section class="relative">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h1 class="text-3xl font-bold text-white">
              {{ getGreeting() }}, {{ studentData?.name?.split(" ")[0] }}!
            </h1>
            <p class="text-zinc-400 mt-1">Bem-vindo ao seu painel pessoal</p>
          </div>

          <button
            class="flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors"
            @click="
              () => {
                localStorage.removeItem('student');
                navigateTo('/login');
              }
            "
          >
            <Icon name="lucide:log-out" class="h-4 w-4" />
            <span class="hidden sm:inline">Sair</span>
          </button>
        </div>

        <div
          class="relative h-64 md:h-96 rounded-2xl overflow-hidden bg-zinc-800/50"
        >
          <TransitionGroup name="carousel" tag="div" class="relative h-full">
            <div
              v-for="(slide, index) in carouselImages"
              v-show="index === currentImageIndex"
              :key="index"
              class="absolute inset-0"
            >
              <div
                class="w-full h-full bg-gradient-to-br flex items-end p-8"
                :class="slide.gradient"
              >
                <div
                  class="w-full bg-black/30 backdrop-blur-sm rounded-2xl p-6"
                >
                  <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">
                    {{ slide.title }}
                  </h2>
                  <p class="text-lg text-white/90">
                    {{ slide.subtitle }}
                  </p>
                </div>
              </div>
            </div>
          </TransitionGroup>

          <button
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-all"
            @click="prevImage"
          >
            <Icon name="lucide:chevron-left" class="h-6 w-6" />
          </button>
          <button
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-all"
            @click="nextImage"
          >
            <Icon name="lucide:chevron-right" class="h-6 w-6" />
          </button>

          <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            <button
              v-for="(_, index) in carouselImages"
              :key="index"
              class="w-2 h-2 rounded-full transition-all"
              :class="
                index === currentImageIndex
                  ? 'bg-orange-500 w-8'
                  : 'bg-white/50 hover:bg-white/70'
              "
              @click="goToImage(index)"
            />
          </div>
        </div>
      </section>

      <section>
        <h2 class="text-2xl font-bold text-white mb-4">Dias da Semana</h2>
        <div class="grid grid-cols-7 gap-2 md:gap-4">
          <button
            v-for="day in weekDays"
            :key="day.value"
            class="card-default p-4 text-center transition-all hover:scale-105"
            :class="
              day.value === currentDay
                ? 'bg-brand-gradient border-transparent'
                : 'hover:bg-zinc-800/70'
            "
          >
            <div
              class="text-xs md:text-sm font-semibold"
              :class="day.value === currentDay ? 'text-white' : 'text-zinc-400'"
            >
              <span class="hidden md:inline">{{ day.name }}</span>
              <span class="md:hidden">{{ day.short }}</span>
            </div>
          </button>
        </div>
      </section>

      <section>
        <h2 class="text-2xl font-bold text-white mb-4">Atalhos Rápidos</h2>
        <div
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4"
        >
          <NuxtLink
            v-for="shortcut in shortcuts"
            :key="shortcut.title"
            :to="shortcut.route"
            class="card-default group hover:bg-zinc-800/70 transition-all hover:scale-105 hover:shadow-xl relative overflow-hidden"
          >
            <div
              v-if="shortcut.count > 0"
              class="absolute top-3 right-3 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full"
            >
              {{ shortcut.count }}
            </div>

            <div
              class="w-14 h-14 rounded-xl bg-gradient-to-br flex items-center justify-center mb-4"
              :class="{
                'from-orange-500 to-red-600': shortcut.color === 'orange',
                'from-blue-500 to-blue-600': shortcut.color === 'blue',
                'from-green-500 to-green-600': shortcut.color === 'green',
                'from-purple-500 to-purple-600': shortcut.color === 'purple',
                'from-pink-500 to-pink-600': shortcut.color === 'pink',
              }"
            >
              <Icon :name="shortcut.icon" class="h-7 w-7 text-white" />
            </div>

            <h3
              class="text-lg font-bold text-white mb-1 group-hover:text-orange-400 transition-colors"
            >
              {{ shortcut.title }}
            </h3>
            <p class="text-sm text-zinc-400">{{ shortcut.description }}</p>

            <Icon
              name="lucide:arrow-right"
              class="absolute bottom-4 right-4 h-5 w-5 text-zinc-600 group-hover:text-orange-500 group-hover:translate-x-1 transition-all"
            />
          </NuxtLink>
        </div>
      </section>
    </div>
  </div>
</template>

<style scoped>
.carousel-enter-active,
.carousel-leave-active {
  transition: opacity 0.5s ease;
}

.carousel-enter-from,
.carousel-leave-to {
  opacity: 0;
}
</style>
