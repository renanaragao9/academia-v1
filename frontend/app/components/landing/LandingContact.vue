<script setup lang="ts">
const form = reactive({
  name: '',
  email: '',
  phone: '',
  plan: '',
  message: '',
})

const sending = ref(false)
const sent = ref(false)

async function handleSubmit() {
  sending.value = true
  // Simulate submission
  await new Promise(resolve => setTimeout(resolve, 1500))
  sending.value = false
  sent.value = true
}

const contactInfo = [
  {
    icon: 'lucide:map-pin',
    title: 'Endereço',
    value: 'Av. Paulista, 1000 - Bela Vista, São Paulo - SP',
  },
  {
    icon: 'lucide:phone',
    title: 'Telefone',
    value: '(11) 9 9999-9999',
  },
  {
    icon: 'lucide:mail',
    title: 'E-mail',
    value: 'contato@ironfit.com.br',
  },
  {
    icon: 'lucide:clock',
    title: 'Horário',
    value: 'Seg–Sex: 6h–23h | Sáb: 7h–20h',
  },
]
</script>

<template>
  <section id="contato" class="relative py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 to-zinc-900" />
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_center,_rgba(249,115,22,0.1),_transparent_60%)]" />

    <div class="relative z-10 max-w-7xl mx-auto px-6">
      <!-- Header -->
      <div class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-medium mb-6">
          <Icon name="lucide:send" class="w-4 h-4" />
          Contato
        </div>
        <h2 class="text-4xl lg:text-5xl font-black text-white mb-4">
          Pronto para
          <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent"> começar?</span>
        </h2>
        <p class="text-zinc-400 text-xl max-w-2xl mx-auto">
          Fale com a nossa equipe e garanta sua primeira semana grátis.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="rounded-3xl border border-white/10 bg-zinc-900/60 backdrop-blur-sm p-8">
          <Transition mode="out-in" name="fade">
            <div v-if="sent" class="flex flex-col items-center justify-center py-12 text-center">
              <div class="w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center mb-6 shadow-xl shadow-orange-500/30">
                <Icon name="lucide:check" class="w-10 h-10 text-white" />
              </div>
              <h3 class="text-2xl font-black text-white mb-2">Mensagem enviada!</h3>
              <p class="text-zinc-400">Nossa equipe entrará em contato em até 24 horas.</p>
              <button
                class="mt-6 text-orange-500 hover:text-orange-400 transition-colors text-sm font-medium"
                @click="sent = false"
              >
                Enviar outra mensagem
              </button>
            </div>

            <form v-else class="space-y-5" @submit.prevent="handleSubmit">
              <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                  <label class="block text-sm font-medium text-zinc-400 mb-2">Nome *</label>
                  <input
                    v-model="form.name"
                    type="text"
                    required
                    placeholder="Seu nome completo"
                    class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/50 transition-colors"
                  />
                </div>
                <div class="col-span-2 sm:col-span-1">
                  <label class="block text-sm font-medium text-zinc-400 mb-2">Telefone</label>
                  <input
                    v-model="form.phone"
                    type="tel"
                    placeholder="(11) 9 9999-9999"
                    class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/50 transition-colors"
                  />
                </div>
              </div>

              <div>
                <label class="block text-sm font-medium text-zinc-400 mb-2">E-mail *</label>
                <input
                  v-model="form.email"
                  type="email"
                  required
                  placeholder="seu@email.com"
                  class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/50 transition-colors"
                />
              </div>

              <div>
                <label class="block text-sm font-medium text-zinc-400 mb-2">Plano de interesse</label>
                <select
                  v-model="form.plan"
                  class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/50 transition-colors appearance-none cursor-pointer"
                >
                  <option value="" disabled selected class="text-zinc-600">Selecione um plano</option>
                  <option value="basico">Básico - R$ 89/mês</option>
                  <option value="pro">Pro - R$ 149/mês</option>
                  <option value="elite">Elite - R$ 249/mês</option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-zinc-400 mb-2">Mensagem</label>
                <textarea
                  v-model="form.message"
                  rows="4"
                  placeholder="Como podemos ajudar?"
                  class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white placeholder-zinc-600 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500/50 transition-colors resize-none"
                />
              </div>

              <button
                type="submit"
                :disabled="sending"
                class="group w-full py-4 rounded-2xl bg-gradient-to-r from-orange-500 to-red-600 text-white font-bold text-lg hover:shadow-xl hover:shadow-orange-500/30 hover:scale-[1.02] transition-all duration-300 disabled:opacity-60 disabled:scale-100 flex items-center justify-center gap-2"
              >
                <Icon v-if="sending" name="lucide:loader-2" class="w-5 h-5 animate-spin" />
                <span>{{ sending ? 'Enviando...' : 'Quero começar agora' }}</span>
                <Icon v-if="!sending" name="lucide:arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </button>
            </form>
          </Transition>
        </div>

        <!-- Contact Info -->
        <div class="space-y-6">
          <div
            v-for="info in contactInfo"
            :key="info.title"
            class="flex items-start gap-4 p-5 rounded-2xl border border-white/5 bg-zinc-900/40 hover:border-orange-500/20 transition-colors duration-300"
          >
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0">
              <Icon :name="info.icon" class="w-6 h-6 text-white" />
            </div>
            <div>
              <div class="text-sm font-semibold text-zinc-400 mb-1">{{ info.title }}</div>
              <div class="text-white font-medium">{{ info.value }}</div>
            </div>
          </div>

          <!-- Social links -->
          <div class="p-5 rounded-2xl border border-white/5 bg-zinc-900/40">
            <div class="text-sm font-semibold text-zinc-400 mb-4">Siga-nos nas redes sociais</div>
            <div class="flex gap-3">
              <a
                v-for="social in [
                  { icon: 'uil:instagram', label: 'Instagram' },
                  { icon: 'uil:facebook', label: 'Facebook' },
                  { icon: 'uil:youtube', label: 'YouTube' },
                  { icon: 'uil:whatsapp', label: 'WhatsApp' },
                ]"
                :key="social.label"
                href="#"
                :aria-label="social.label"
                class="w-10 h-10 rounded-xl bg-zinc-800 border border-zinc-700 flex items-center justify-center text-zinc-400 hover:bg-gradient-to-br hover:from-orange-500 hover:to-red-600 hover:text-white hover:border-transparent transition-all duration-300"
              >
                <Icon :name="social.icon" class="w-5 h-5" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
