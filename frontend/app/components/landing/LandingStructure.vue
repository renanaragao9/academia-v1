<script setup lang="ts">
const features = [
  {
    icon: 'lucide:wifi',
    title: 'Wi-Fi em toda academia',
    description: 'Conectividade de alta velocidade para você acessar suas playlists e apps de treino.',
  },
  {
    icon: 'lucide:thermometer',
    title: 'Ar-condicionado central',
    description: 'Ambiente climatizado para o máximo de conforto durante seus treinos.',
  },
  {
    icon: 'lucide:shirt',
    title: 'Vestiários Premium',
    description: 'Vestiários espaçosos com armários individuais, chuveiros com água quente e toalhas.',
  },
  {
    icon: 'lucide:parking-square',
    title: 'Estacionamento gratuito',
    description: 'Vagas monitoradas 24h para facilitar seu acesso sem preocupações.',
  },
  {
    icon: 'lucide:coffee',
    title: 'Área de Nutrição',
    description: 'Lanchonete fitness com proteínas, sucos naturais e suplementação.',
  },
  {
    icon: 'lucide:monitor',
    title: 'App Exclusivo',
    description: 'Acompanhe seu progresso, agende aulas e acesse suas fichas de treino pelo celular.',
  },
]
</script>

<template>
  <section id="estrutura" class="relative py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-zinc-950 to-zinc-900" />
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,_rgba(220,38,38,0.08),_transparent_60%)]" />

    <div class="relative z-10 max-w-7xl mx-auto px-6">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <!-- Left: Content -->
        <div>
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-medium mb-6">
            <Icon name="lucide:building-2" class="w-4 h-4" />
            Nossa Estrutura
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-white mb-6">
            Tudo que você precisa
            <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent"> em um só lugar</span>
          </h2>
          <p class="text-zinc-400 text-lg mb-10 leading-relaxed">
            Nossa academia foi projetada para oferecer a melhor experiência possível. Espaços modernos, equipamentos premium e uma infraestrutura pensada para o seu bem-estar.
          </p>

          <!-- Feature list -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div
              v-for="feature in features"
              :key="feature.title"
              class="group flex items-start gap-3 p-4 rounded-2xl border border-white/5 bg-zinc-800/40 hover:bg-zinc-800/60 hover:border-orange-500/20 transition-all duration-300"
            >
              <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                <Icon :name="feature.icon" class="w-5 h-5 text-white" />
              </div>
              <div>
                <div class="text-sm font-bold text-white mb-0.5">{{ feature.title }}</div>
                <div class="text-xs text-zinc-500 leading-relaxed">{{ feature.description }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Visual Stats -->
        <div class="space-y-4">
          <!-- Big stat cards -->
          <div class="grid grid-cols-2 gap-4">
            <div class="rounded-3xl bg-gradient-to-br from-orange-500 to-red-600 p-8 text-white shadow-2xl shadow-orange-500/30">
              <Icon name="lucide:dumbbell" class="w-8 h-8 mb-3 opacity-80" />
              <div class="text-4xl font-black mb-1">500+</div>
              <div class="text-sm opacity-80">Equipamentos modernos</div>
            </div>
            <div class="rounded-3xl border border-white/10 bg-zinc-800/60 p-8 text-white">
              <Icon name="lucide:clock" class="w-8 h-8 mb-3 text-orange-500" />
              <div class="text-4xl font-black mb-1">24h</div>
              <div class="text-sm text-zinc-400">Acesso para plano Elite</div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div class="rounded-3xl border border-white/10 bg-zinc-800/60 p-8 text-white">
              <Icon name="lucide:square-activity" class="w-8 h-8 mb-3 text-orange-500" />
              <div class="text-4xl font-black mb-1">1.200m²</div>
              <div class="text-sm text-zinc-400">De área total</div>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-zinc-700 to-zinc-800 border border-white/10 p-8 text-white">
              <Icon name="lucide:star" class="w-8 h-8 mb-3 text-amber-400" />
              <div class="text-4xl font-black mb-1">4.9</div>
              <div class="text-sm text-zinc-400">Avaliação média no Google</div>
            </div>
          </div>

          <!-- Opening Hours -->
          <div class="rounded-3xl border border-white/5 bg-zinc-800/60 backdrop-blur-sm p-6">
            <div class="flex items-center gap-2 mb-4">
              <Icon name="lucide:clock-4" class="w-5 h-5 text-orange-500" />
              <span class="font-bold text-white">Horários de Funcionamento</span>
            </div>
            <div class="space-y-2 text-sm">
              <div class="flex justify-between text-zinc-300">
                <span>Segunda a Sexta</span>
                <span class="font-semibold text-white">06h – 23h</span>
              </div>
              <div class="flex justify-between text-zinc-300">
                <span>Sábados</span>
                <span class="font-semibold text-white">07h – 20h</span>
              </div>
              <div class="flex justify-between text-zinc-300">
                <span>Domingos e Feriados</span>
                <span class="font-semibold text-white">08h – 14h</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
