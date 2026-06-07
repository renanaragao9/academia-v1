<script setup lang="ts">
interface Student {
  id: number;
  name: string;
  code: string;
  email?: string;
  phone?: string;
}

interface PlanType {
  id: number;
  name: string;
}

interface PaymentType {
  id: number;
  name: string;
}

interface MonthlyFee {
  id: number;
  uuid: string;
  startDate: string;
  endDate: string;
  datePayment: string | null;
  fullPayment: string;
  discountPayment: string | null;
  amountPaid: string | null;
  finalPayment: number;
  planType: PlanType;
  paymentType: PaymentType;
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

const monthlyFees = ref<MonthlyFee[]>([]);
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
    const response = await $fetch<ApiResponse>(`${apiBase}/v1/monthly_fees`, {
      method: "POST",
      body: {
        code: student.code,
        email: student.email ?? undefined,
        phone: student.phone ?? undefined,
      },
    });

    const raw = response.data ?? [];
    monthlyFees.value = raw.map(
      (item) =>
        convertKeysToCamel(
          item as Record<string, unknown>,
        ) as unknown as MonthlyFee,
    );
  } catch (e) {
    error.value = "Nao foi possivel carregar as mensalidades.";
    console.error(e);
  } finally {
    isLoading.value = false;
  }
});

const summary = computed(() => {
  const total = monthlyFees.value.length;
  const paid = monthlyFees.value.filter((fee) => !!fee.datePayment).length;
  const pending = total - paid;
  return { total, paid, pending };
});

function currency(value: number | string | null): string {
  const numeric = Number(value ?? 0);
  return new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  }).format(numeric);
}

function formatDate(value: string | null): string {
  if (!value) {
    return "-";
  }

  const [year, month, day] = value.split("-");
  return `${day}/${month}/${year}`;
}

function status(fee: MonthlyFee): "Pago" | "Pendente" {
  return fee.datePayment ? "Pago" : "Pendente";
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
            Mensalidades
          </h1>
          <p class="text-sm sm:text-base text-zinc-400">
            Consulte seus pagamentos e histórico
          </p>
        </div>
      </div>

      <div v-if="isLoading" class="card-default text-center py-20">
        <Icon
          name="lucide:loader-2"
          class="h-12 w-12 text-sky-500 mx-auto mb-4 animate-spin"
        />
        <p class="text-zinc-400">Carregando mensalidades...</p>
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
        v-else-if="monthlyFees.length === 0"
        class="card-default text-center py-20"
      >
        <Icon
          name="lucide:credit-card"
          class="h-16 w-16 text-purple-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">
          Nenhuma mensalidade encontrada
        </h2>
        <p class="text-zinc-400">
          Voce ainda nao possui mensalidades registradas.
        </p>
      </div>

      <div v-else class="space-y-4 sm:space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
          <div class="card-default p-4">
            <p class="text-zinc-400 text-sm">Total</p>
            <p class="text-2xl font-bold text-white mt-1">
              {{ summary.total }}
            </p>
          </div>
          <div class="card-default p-4">
            <p class="text-zinc-400 text-sm">Pagas</p>
            <p class="text-2xl font-bold text-emerald-400 mt-1">
              {{ summary.paid }}
            </p>
          </div>
          <div class="card-default p-4">
            <p class="text-zinc-400 text-sm">Pendentes</p>
            <p class="text-2xl font-bold text-amber-400 mt-1">
              {{ summary.pending }}
            </p>
          </div>
        </div>

        <div class="card-default overflow-hidden">
          <div
            v-for="fee in monthlyFees"
            :key="fee.id"
            class="px-5 py-4 border-b border-zinc-700/50 last:border-b-0"
          >
            <div
              class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
            >
              <div class="space-y-1 min-w-0">
                <p class="text-white font-semibold truncate">
                  {{ fee.planType.name }}
                </p>
                <p class="text-xs text-zinc-400">
                  {{ formatDate(fee.startDate) }} -
                  {{ formatDate(fee.endDate) }}
                </p>
                <p class="text-xs text-zinc-500 truncate">
                  {{ fee.paymentType.name }}
                </p>
              </div>

              <div
                class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6"
              >
                <div class="text-sm min-w-[120px]">
                  <p class="text-zinc-400">Valor final</p>
                  <p class="font-semibold text-white">
                    {{ currency(fee.finalPayment) }}
                  </p>
                </div>

                <div class="text-sm min-w-[120px]">
                  <p class="text-zinc-400">Pago</p>
                  <p class="font-semibold text-white">
                    {{ currency(fee.amountPaid ?? fee.finalPayment) }}
                  </p>
                </div>

                <div class="text-sm min-w-[120px]">
                  <p class="text-zinc-400">Pagamento</p>
                  <p class="font-semibold text-white">
                    {{ formatDate(fee.datePayment) }}
                  </p>
                </div>

                <span
                  :class="[
                    'inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold border self-start',
                    status(fee) === 'Pago'
                      ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                      : 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                  ]"
                >
                  {{ status(fee) }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
