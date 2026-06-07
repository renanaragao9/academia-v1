<script setup lang="ts">
// ---------------------------------------------------------------------------
// Tipos
// ---------------------------------------------------------------------------
interface AcademyConfig {
  id: number;
  name: string;
  cnpj: string | null;
  description: string | null;
  contact: {
    email: string | null;
    phone: string | null;
    whatsapp: string | null;
    emergency_phone: string | null;
  };
  address: {
    zip_code: string | null;
    street: string | null;
    number: string | null;
    complement: string | null;
    neighborhood: string | null;
    city: string | null;
    state: string | null;
    full: string | null;
  };
  social: {
    website: string | null;
    instagram: string | null;
    facebook: string | null;
    youtube: string | null;
  };
  branding: {
    logo: string | null;
    favicon: string | null;
  };
  schedule: {
    opening_hours: string | null;
    opening_time: string | null;
    closing_time: string | null;
  };
  settings: {
    allow_student_registration: boolean;
    allow_online_assessments: boolean;
    send_email_notifications: boolean;
    send_whatsapp_notifications: boolean;
    default_training_duration_days: number | null;
    default_assessment_duration_days: number | null;
    max_workouts_per_student: number | null;
  };
  is_active: boolean;
}

// ---------------------------------------------------------------------------
// Layout
// ---------------------------------------------------------------------------
// Usa layout landing para a página inicial
definePageMeta({
  layout: "landing",
});

// ---------------------------------------------------------------------------
// Busca as configurações da academia direto na página (sem store/service)
// useAsyncData garante SSR + cache automático por key
// ---------------------------------------------------------------------------
const {
  public: { apiBase },
} = useRuntimeConfig();

interface ConfigurationResponse {
  data: AcademyConfig;
}

const { data: config, error } = await useAsyncData<AcademyConfig>(
  "academy-config",
  () =>
    $fetch<ConfigurationResponse>(`${apiBase}/v1/configuration`).then(
      (res) => res.data,
    ),
  {
    // Não re-busca ao navegar de volta para a página (cache)
    dedupe: "defer",
  },
);

// Disponibiliza para todos os componentes filhos via provide
provide("academyConfig", config);

// Tratamento de erro (pode ser usado para logging ou fallback UI)
if (error.value) {
  console.error("Erro ao buscar configuração da academia:", error.value);
}

// ---------------------------------------------------------------------------
// SEO dinâmico com fallback para valores estáticos
// ---------------------------------------------------------------------------
const academyName = computed(() => config.value?.name ?? "IronFit Academia");
const academyDescription = computed(
  () =>
    config.value?.description ??
    "A academia completa com musculação, cardio, yoga, artes marciais, natação e muito mais. Equipamentos de última geração e professores certificados. Primeira semana grátis!",
);

useSeoMeta({
  title: () => `${academyName.value} — Transforme seu corpo e sua mente`,
  description: () => academyDescription.value,
  ogTitle: () => `${academyName.value} — Transforme seu corpo e sua mente`,
  ogDescription: () => academyDescription.value,
  ogType: "website",
  ogUrl: () => config.value?.social?.website ?? "https://ironfit.com.br",
  ogSiteName: () => academyName.value,
  twitterCard: "summary_large_image",
  twitterTitle: () => `${academyName.value} — Transforme seu corpo e sua mente`,
  twitterDescription: () => academyDescription.value,
  robots: "index, follow",
});

useHead({
  htmlAttrs: { lang: "pt-BR" },
  link: [
    {
      rel: "canonical",
      href: () => config.value?.social?.website ?? "https://ironfit.com.br",
    },
  ],
});
</script>

<template>
  <div>
    <LandingNavbar />
    <LandingHero />
    <LandingModalities />
    <LandingStructure />
    <LandingPlans />
    <LandingCta />
    <LandingTestimonials />
    <LandingContact />
    <LandingFooter />
  </div>
</template>
