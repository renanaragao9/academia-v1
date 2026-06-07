<script setup lang="ts">
const modalities = [
  {
    icon: 'lucide:dumbbell',
    title: 'Musculação',
    description: 'Equipamentos de última geração para hipertrofia, força e definição muscular. Acompanhamento personalizado com fichas de treino.',
    badge: 'Mais popular',
    color: 'orange',
  },
  {
    icon: 'lucide:heart-pulse',
    title: 'Cardio & HIIT',
    description: 'Esteiras, bicicletas e elípticos de alto desempenho. Aulas de HIIT para queimar gordura de forma eficiente.',
    badge: null,
    color: 'red',
  },
  {
    icon: 'lucide:person-standing',
    title: 'Yoga & Pilates',
    description: 'Melhore flexibilidade, postura e equilíbrio mental. Aulas conduzidas por instrutores certificados internacionalmente.',
    badge: null,
    color: 'amber',
  },
  {
    icon: 'lucide:swords',
    title: 'Artes Marciais',
    description: 'Muay Thai, Jiu-Jitsu e boxe para todos os níveis. Desenvolva disciplina, autodefesa e condicionamento físico.',
    badge: 'Novo',
    color: 'orange',
  },
  {
    icon: 'lucide:waves',
    title: 'Natação',
    description: 'Piscina semiolímpica aquecida com raia livre e aulas para todas as idades e níveis de habilidade.',
    badge: null,
    color: 'red',
  },
  {
    icon: 'lucide:music',
    title: 'Aulas em Grupo',
    description: 'Zumba, spinning, step e muito mais. Aulas energizantes que tornam o treino uma experiência incrível.',
    badge: null,
    color: 'amber',
  },
]

const colorMap: Record<string, string> = {
  orange: 'from-orange-500 to-red-500',
  red: 'from-red-500 to-rose-600',
  amber: 'from-amber-500 to-orange-500',
}

const bgColorMap: Record<string, string> = {
  orange: 'bg-orange-500/10 border-orange-500/20 group-hover:border-orange-500/40',
  red: 'bg-red-500/10 border-red-500/20 group-hover:border-red-500/40',
  amber: 'bg-amber-500/10 border-amber-500/20 group-hover:border-amber-500/40',
}

const iconColorMap: Record<string, string> = {
  orange: 'text-orange-500',
  red: 'text-red-500',
  amber: 'text-amber-500',
}
</script>

<template>
  <section id="modalidades" class="relative py-24 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(249,115,22,0.05),_transparent_70%)]" />

    <div class="relative z-10 max-w-7xl mx-auto px-6">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-medium mb-6">
          <Icon name="lucide:layers" class="w-4 h-4" />
          Modalidades
        </div>
        <h2 class="text-4xl lg:text-5xl font-black text-white mb-4">
          Encontre a atividade
          <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">perfeita para você</span>
        </h2>
        <p class="text-zinc-400 text-xl max-w-2xl mx-auto">
          Oferecemos diversas modalidades para que você encontre a que mais se identifica e alcance seus objetivos.
        </p>
      </div>

      <!-- Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="modality in modalities"
          :key="modality.title"
          class="group relative rounded-2xl border bg-zinc-900/60 backdrop-blur-sm p-6 hover:bg-zinc-800/60 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-black/40 cursor-default"
          :class="bgColorMap[modality.color]"
        >
          <!-- Badge -->
          <div v-if="modality.badge" class="absolute top-4 right-4">
            <span
              class="px-3 py-1 rounded-full text-xs font-bold"
              :class="modality.badge === 'Novo' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-orange-500/20 text-orange-400 border border-orange-500/30'"
            >
              {{ modality.badge }}
            </span>
          </div>

          <!-- Icon -->
          <div
            class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 bg-gradient-to-br shadow-lg"
            :class="colorMap[modality.color]"
          >
            <Icon :name="modality.icon" class="w-7 h-7 text-white" />
          </div>

          <h3 class="text-xl font-bold text-white mb-2">{{ modality.title }}</h3>
          <p class="text-zinc-400 text-sm leading-relaxed">{{ modality.description }}</p>

          <div class="mt-4 flex items-center gap-1.5 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300" :class="iconColorMap[modality.color]">
            Saiba mais
            <Icon name="lucide:arrow-right" class="w-4 h-4" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
