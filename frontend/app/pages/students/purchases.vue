<script setup lang="ts">
interface Student {
  id: number;
  name: string;
  code: string;
  email?: string;
  phone?: string;
}

interface PurchaseItem {
  id: number;
  quantity: number;
  unitPrice: number;
  subtotal: number;
  item: {
    id: number;
    name: string;
  };
}

interface Purchase {
  id: number;
  uuid: string;
  status: string | null;
  observation: string | null;
  dateSale: string;
  amountPrice: number;
  discountAmount: number;
  totalAmount: number;
  items: PurchaseItem[];
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

const purchases = ref<Purchase[]>([]);
const isLoading = ref(true);
const error = ref<string | null>(null);
const expandedPurchases = ref<Set<number>>(new Set());

onMounted(async () => {
  const storedStudent = localStorage.getItem("student");
  if (!storedStudent) {
    navigateTo("/login");
    return;
  }

  const student = JSON.parse(storedStudent) as Student;

  try {
    const response = await $fetch<ApiResponse>(`${apiBase}/v1/purchases`, {
      method: "POST",
      body: {
        code: student.code,
        email: student.email ?? undefined,
        phone: student.phone ?? undefined,
      },
    });

    const raw = response.data ?? [];
    purchases.value = raw.map(
      (item) =>
        convertKeysToCamel(
          item as Record<string, unknown>,
        ) as unknown as Purchase,
    );
  } catch (e) {
    error.value = "Nao foi possivel carregar as compras.";
    console.error(e);
  } finally {
    isLoading.value = false;
  }
});

const summary = computed(() => {
  const totalCount = purchases.value.length;
  const totalSpent = purchases.value.reduce(
    (acc, purchase) => acc + Number(purchase.totalAmount ?? 0),
    0,
  );
  const totalItems = purchases.value.reduce(
    (acc, purchase) => acc + purchase.items.length,
    0,
  );

  return {
    totalCount,
    totalSpent,
    totalItems,
  };
});

function togglePurchase(id: number): void {
  if (expandedPurchases.value.has(id)) {
    expandedPurchases.value.delete(id);
    return;
  }

  expandedPurchases.value.add(id);
}

function formatDate(dateStr: string | null): string {
  if (!dateStr) {
    return "-";
  }

  const [date, time] = dateStr.split(" ");
  if (!date) {
    return "-";
  }

  const [year, month, day] = date.split("-");
  return time
    ? `${day}/${month}/${year} ${time.slice(0, 5)}`
    : `${day}/${month}/${year}`;
}

function currency(value: number): string {
  return new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  }).format(Number(value));
}

function statusLabel(status: string | null): string {
  if (status === "paid") return "Pago";
  if (status === "open") return "Aberto";
  if (status === "canceled") return "Cancelado";
  return "Sem status";
}

function statusClass(status: string | null): string {
  if (status === "paid")
    return "bg-emerald-500/10 text-emerald-400 border-emerald-500/20";
  if (status === "open")
    return "bg-amber-500/10 text-amber-400 border-amber-500/20";
  if (status === "canceled")
    return "bg-red-500/10 text-red-400 border-red-500/20";
  return "bg-zinc-700/50 text-zinc-300 border-zinc-600";
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
          <h1 class="text-2xl sm:text-3xl font-bold text-white">Compras</h1>
          <p class="text-sm sm:text-base text-zinc-400">
            Histórico de compras na academia
          </p>
        </div>
      </div>

      <div v-if="isLoading" class="card-default text-center py-20">
        <Icon
          name="lucide:loader-2"
          class="h-12 w-12 text-pink-500 mx-auto mb-4 animate-spin"
        />
        <p class="text-zinc-400">Carregando compras...</p>
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
        v-else-if="purchases.length === 0"
        class="card-default text-center py-20"
      >
        <Icon
          name="lucide:shopping-bag"
          class="h-16 w-16 text-pink-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">
          Nenhuma compra encontrada
        </h2>
        <p class="text-zinc-400">Voce ainda nao possui compras registradas.</p>
      </div>

      <div v-else class="space-y-4 sm:space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
          <div class="card-default p-4">
            <p class="text-zinc-400 text-sm">Compras</p>
            <p class="text-2xl font-bold text-white mt-1">
              {{ summary.totalCount }}
            </p>
          </div>
          <div class="card-default p-4">
            <p class="text-zinc-400 text-sm">Itens comprados</p>
            <p class="text-2xl font-bold text-pink-400 mt-1">
              {{ summary.totalItems }}
            </p>
          </div>
          <div class="card-default p-4">
            <p class="text-zinc-400 text-sm">Total gasto</p>
            <p class="text-2xl font-bold text-emerald-400 mt-1">
              {{ currency(summary.totalSpent) }}
            </p>
          </div>
        </div>

        <div class="card-default overflow-hidden">
          <div
            v-for="purchase in purchases"
            :key="purchase.id"
            class="border-b border-zinc-700/50 last:border-b-0"
          >
            <button
              class="w-full px-5 py-4 text-left"
              @click="togglePurchase(purchase.id)"
            >
              <div
                class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4"
              >
                <div class="space-y-1 min-w-0">
                  <p class="text-white font-semibold">
                    Compra #{{ purchase.id }}
                  </p>
                  <p class="text-xs text-zinc-400">
                    {{ formatDate(purchase.dateSale) }}
                  </p>
                  <p class="text-xs text-zinc-500 truncate">
                    {{ purchase.uuid }}
                  </p>
                </div>

                <div
                  class="grid grid-cols-2 sm:flex sm:flex-wrap sm:items-center gap-3 lg:gap-5"
                >
                  <div>
                    <p class="text-xs text-zinc-400">Subtotal</p>
                    <p class="text-sm font-semibold text-white">
                      {{ currency(purchase.amountPrice) }}
                    </p>
                  </div>
                  <div>
                    <p class="text-xs text-zinc-400">Desconto</p>
                    <p class="text-sm font-semibold text-white">
                      {{ currency(purchase.discountAmount) }}
                    </p>
                  </div>
                  <div>
                    <p class="text-xs text-zinc-400">Total</p>
                    <p class="text-sm font-semibold text-emerald-400">
                      {{ currency(purchase.totalAmount) }}
                    </p>
                  </div>

                  <span
                    :class="[
                      'inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold border col-span-1',
                      statusClass(purchase.status),
                    ]"
                  >
                    {{ statusLabel(purchase.status) }}
                  </span>

                  <Icon
                    :name="
                      expandedPurchases.has(purchase.id)
                        ? 'lucide:chevron-up'
                        : 'lucide:chevron-down'
                    "
                    class="h-4 w-4 text-zinc-400 justify-self-end self-center"
                  />
                </div>
              </div>
            </button>

            <div
              v-if="expandedPurchases.has(purchase.id)"
              class="px-5 pb-4 border-t border-zinc-700/40"
            >
              <div class="pt-3 space-y-2">
                <p class="text-xs uppercase tracking-wide text-zinc-500">
                  Itens
                </p>

                <div
                  v-for="item in purchase.items"
                  :key="item.id"
                  class="bg-zinc-800/50 rounded-lg px-3 py-2"
                >
                  <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2"
                  >
                    <p class="text-sm text-white font-medium">
                      {{ item.item.name }}
                    </p>
                    <p class="text-xs text-zinc-400">
                      Qtd. {{ item.quantity }}
                    </p>
                  </div>
                  <div class="flex flex-wrap gap-4 mt-1 text-xs text-zinc-400">
                    <span>Unitario: {{ currency(item.unitPrice) }}</span>
                    <span>Subtotal: {{ currency(item.subtotal) }}</span>
                  </div>
                </div>

                <p
                  v-if="purchase.observation"
                  class="text-xs text-zinc-500 italic pt-1"
                >
                  Obs: {{ purchase.observation }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
