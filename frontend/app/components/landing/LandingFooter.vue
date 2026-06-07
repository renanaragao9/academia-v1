<script setup lang="ts">
interface AcademyConfig {
  name?: string | null;
  description?: string | null;
  address?: { city?: string | null };
  social?: {
    instagram?: string | null;
    facebook?: string | null;
    youtube?: string | null;
  };
}

const config = inject<Ref<AcademyConfig | null>>("academyConfig");
const academyName = computed(() => config?.value?.name || "IronFit");
const socialLinks = computed(() => [
  {
    icon: "uil:instagram",
    label: "Instagram",
    url: config?.value?.social?.instagram
      ? `https://instagram.com/${config.value.social.instagram.replace("@", "")}`
      : "#",
  },
  {
    icon: "uil:facebook",
    label: "Facebook",
    url: config?.value?.social?.facebook
      ? `https://facebook.com/${config.value.social.facebook}`
      : "#",
  },
  {
    icon: "uil:youtube",
    label: "YouTube",
    url: config?.value?.social?.youtube
      ? `https://youtube.com/${config.value.social.youtube}`
      : "#",
  },
]);
</script>

<template>
  <footer class="relative border-t border-white/5 bg-zinc-950">
    <div
      class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(249,115,22,0.04),_transparent_60%)]"
    />

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-16">
      <div class="grid md:grid-cols-4 gap-10 mb-12">
        <div class="md:col-span-2">
          <div class="flex items-center gap-2 mb-4">
            <div
              class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/30"
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
          </div>
          <p class="text-zinc-500 text-sm leading-relaxed max-w-xs">
            {{
              config?.value?.description ||
              "Transformando vidas através do fitness desde 2009. A academia que cuida do seu corpo e da sua mente."
            }}
          </p>
        </div>

        <div>
          <h4 class="text-white font-bold text-sm mb-4">Academia</h4>
          <ul class="space-y-2.5">
            <li
              v-for="link in [
                'Modalidades',
                'Estrutura',
                'Planos',
                'Depoimentos',
                'Contato',
              ]"
              :key="link"
            >
              <a
                :href="`#${link.toLowerCase()}`"
                class="text-zinc-500 hover:text-white text-sm transition-colors"
                >{{ link }}</a
              >
            </li>
          </ul>
        </div>

        <div>
          <h4 class="text-white font-bold text-sm mb-4">Legal</h4>
          <ul class="space-y-2.5">
            <li
              v-for="link in ['Termos de Uso', 'Privacidade', 'Cookies']"
              :key="link"
            >
              <a
                href="#"
                class="text-zinc-500 hover:text-white text-sm transition-colors"
                >{{ link }}</a
              >
            </li>
          </ul>
        </div>
      </div>

      <div
        class="pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-zinc-600"
      >
        <span
          >© {{ new Date().getFullYear() }} {{ academyName }}. Todos os direitos
          reservados.</span
        >
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-3">
            <a
              v-for="link in socialLinks"
              :key="link.label"
              :href="link.url"
              :title="link.label"
              class="text-zinc-500 hover:text-orange-500 transition-colors"
              target="_blank"
              rel="noopener noreferrer"
            >
              <Icon :name="link.icon" class="w-4 h-4" />
            </a>
          </div>
          <span class="flex items-center gap-1">
            Feito com
            <Icon
              name="lucide:heart"
              class="w-3 h-3 text-red-500 fill-red-500"
            />
            em {{ config?.value?.address?.city || "São Paulo" }}
          </span>
        </div>
      </div>
    </div>
  </footer>
</template>
