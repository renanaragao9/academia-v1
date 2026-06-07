<script setup lang="ts">
interface AcademyConfig {
  description: string | null;
}

const config = inject<Ref<AcademyConfig | null>>("academyConfig");

const stats = [
  { value: "2.500+", label: "Alunos ativos" },
  { value: "15+", label: "Anos de experiência" },
  { value: "40+", label: "Professores certificados" },
  { value: "98%", label: "Satisfação dos clientes" },
];

const description = computed(
  () =>
    config?.value?.description ||
    "A academia que vai além do físico. Equipamentos de última geração, professores especializados e uma comunidade que te impulsa a superar limites.",
);
</script>

<template>
  <section class="relative min-h-screen flex items-center overflow-hidden">
    <div
      class="absolute inset-0 bg-gradient-to-br from-zinc-950 via-zinc-900 to-zinc-950"
    />
    <div
      class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(249,115,22,0.15),_transparent_60%)]"
    />
    <div
      class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(220,38,38,0.1),_transparent_60%)]"
    />

    <div
      class="absolute inset-0 opacity-10"
      style="
        background-image:
          linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
          linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 60px 60px;
      "
    />

    <div
      class="absolute top-1/4 right-1/4 w-96 h-96 rounded-full bg-orange-500/10 blur-3xl animate-pulse"
    />
    <div
      class="absolute bottom-1/4 left-1/4 w-64 h-64 rounded-full bg-red-600/10 blur-3xl animate-pulse"
      style="animation-delay: 1s"
    />

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-28 pb-20">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-8">
          <div
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-medium"
          >
            <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse" />
            Academia completa · Aberto agora
          </div>

          <h1
            class="text-5xl lg:text-7xl font-black leading-none tracking-tight"
          >
            <span class="text-white">Transforme</span>
            <br />
            <span class="text-white">seu</span>
            <span
              class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent"
            >
              corpo</span
            >
            <br />
            <span class="text-white">e sua</span>
            <span
              class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent"
            >
              mente</span
            >
          </h1>

          <p class="text-xl text-zinc-400 leading-relaxed max-w-lg">
            {{ description }}
          </p>

          <div class="flex flex-col sm:flex-row gap-4">
            <a
              href="#planos"
              class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-orange-500 to-red-600 text-white font-bold text-lg hover:shadow-2xl hover:shadow-orange-500/30 hover:scale-105 transition-all duration-300"
            >
              Comece hoje mesmo
              <Icon
                name="lucide:arrow-right"
                class="w-5 h-5 group-hover:translate-x-1 transition-transform"
              />
            </a>
            <a
              href="#modalidades"
              class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl border border-white/10 text-white font-semibold text-lg hover:bg-white/5 hover:border-white/20 transition-all duration-300"
            >
              <Icon name="lucide:play-circle" class="w-5 h-5 text-orange-500" />
              Ver modalidades
            </a>
          </div>
        </div>

        <div class="lg:pl-8">
          <div class="relative">
            <div
              class="relative rounded-3xl overflow-hidden border border-white/10 bg-gradient-to-br from-zinc-800/80 to-zinc-900/80 backdrop-blur-xl p-8 shadow-2xl"
            >
              <div
                class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-orange-500/50 to-transparent"
              />

              <div class="flex justify-center mb-8">
                <div
                  class="w-24 h-24 rounded-3xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-2xl shadow-orange-500/40"
                >
                  <Icon name="lucide:dumbbell" class="w-12 h-12 text-white" />
                </div>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div
                  v-for="stat in stats"
                  :key="stat.label"
                  class="rounded-2xl bg-zinc-800/60 border border-white/5 p-4 text-center hover:border-orange-500/30 transition-colors duration-300"
                >
                  <div class="text-3xl font-black text-white mb-1">
                    {{ stat.value }}
                  </div>
                  <div class="text-xs text-zinc-500 font-medium">
                    {{ stat.label }}
                  </div>
                </div>
              </div>

              <div
                class="mt-6 p-4 rounded-2xl bg-orange-500/10 border border-orange-500/20"
              >
                <div class="flex items-center gap-3">
                  <Icon
                    name="lucide:shield-check"
                    class="w-8 h-8 text-orange-500 flex-shrink-0"
                  />
                  <div>
                    <div class="text-sm font-bold text-white">
                      Primeira semana grátis
                    </div>
                    <div class="text-xs text-zinc-400">
                      Sem compromisso, cancele quando quiser
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div
              class="absolute -top-4 -right-4 bg-orange-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg shadow-orange-500/40 rotate-6"
            >
              #1 em resultados
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-zinc-600"
    >
      <span class="text-xs font-medium tracking-widest uppercase">Rolar</span>
      <div
        class="w-0.5 h-8 bg-gradient-to-b from-zinc-600 to-transparent animate-bounce"
      />
    </div>
  </section>
</template>
