<script setup lang="ts">
interface AcademyConfig {
  name: string | null;
}

const scrolled = ref(false);
const mobileOpen = ref(false);

const config = inject<Ref<AcademyConfig | null>>("academyConfig");

const navLinks = [
  { label: "Planos", href: "#planos" },
  { label: "Modalidades", href: "#modalidades" },
  { label: "Estrutura", href: "#estrutura" },
  { label: "Depoimentos", href: "#depoimentos" },
  { label: "Contato", href: "#contato" },
];

const academyName = computed(() => config?.value?.name || "IronFit");

onMounted(() => {
  window.addEventListener("scroll", () => {
    scrolled.value = window.scrollY > 20;
  });
});
</script>

<template>
  <header
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="
      scrolled
        ? 'bg-zinc-950/95 backdrop-blur-md shadow-lg shadow-black/20 border-b border-white/5'
        : 'bg-transparent'
    "
  >
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <NuxtLink to="/" class="flex items-center gap-2 group">
        <div
          class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300"
        >
          <Icon name="lucide:dumbbell" class="w-5 h-5 text-white" />
        </div>
        <span
          v-if="academyName"
          class="text-xl font-black tracking-tight text-white"
        >
          {{ academyName }}
        </span>
        <span v-else class="text-xl font-black tracking-tight">
          <span class="text-white">IRON</span
          ><span class="text-orange-500">FIT</span>
        </span>
      </NuxtLink>

      <nav class="hidden md:flex items-center gap-8">
        <a
          v-for="link in navLinks"
          :key="link.href"
          :href="link.href"
          class="text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 relative group"
        >
          {{ link.label }}
          <span
            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"
          />
        </a>
      </nav>

      <div class="hidden md:flex items-center gap-3">
        <NuxtLink
          to="/login"
          class="text-sm font-medium text-zinc-400 hover:text-white transition-colors px-4 py-2"
        >
          Entrar
        </NuxtLink>
        <a
          href="#planos"
          class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-semibold hover:shadow-lg hover:shadow-orange-500/30 hover:scale-105 transition-all duration-300"
        >
          Começar agora
        </a>
      </div>

      <button
        class="md:hidden text-zinc-400 hover:text-white transition-colors"
        aria-label="Abrir menu"
        @click="mobileOpen = !mobileOpen"
      >
        <Icon :name="mobileOpen ? 'lucide:x' : 'lucide:menu'" class="w-6 h-6" />
      </button>
    </div>

    <Transition
      enter-active-class="transition-all duration-300 ease-out"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition-all duration-200 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div
        v-if="mobileOpen"
        class="md:hidden bg-zinc-900/95 backdrop-blur-md border-t border-white/5 px-6 py-4 flex flex-col gap-4"
      >
        <a
          v-for="link in navLinks"
          :key="link.href"
          :href="link.href"
          class="text-zinc-300 hover:text-white font-medium py-2 transition-colors"
          @click="mobileOpen = false"
        >
          {{ link.label }}
        </a>
        <a
          href="#planos"
          class="w-full text-center py-3 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 text-white font-semibold"
          @click="mobileOpen = false"
        >
          Começar agora
        </a>
      </div>
    </Transition>
  </header>
</template>
