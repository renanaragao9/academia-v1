<script setup lang="ts">
interface AcademyConfig {
  id: number;
  name: string;
  cnpj: string | null;
  description: string | null;
  contact: {
    email: string | null;
    phone: string | null;
    whatsapp: string | null;
    emergencyPhone: string | null;
  };
  address: {
    zipCode: string | null;
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
    openingHours: string | null;
    openingTime: string | null;
    closingTime: string | null;
  };
  settings: {
    allowStudentRegistration: boolean;
    allowOnlineAssessments: boolean;
    sendEmailNotifications: boolean;
    sendWhatsappNotifications: boolean;
    defaultTrainingDurationDays: number | null;
    defaultAssessmentDurationDays: number | null;
    maxWorkoutsPerStudent: number | null;
  };
  isActive: boolean;
}

definePageMeta({
  layout: "landing",
});

const {
  public: { apiBase },
} = useRuntimeConfig();

interface ConfigurationResponse {
  data: Record<string, unknown>;
}

const { data: config, error } = await useAsyncData<AcademyConfig>(
  "academy-config",
  () =>
    $fetch<ConfigurationResponse>(`${apiBase}/v1/configuration`).then((res) =>
      convertKeysToCamel<AcademyConfig>(res.data as AcademyConfig),
    ),
  {
    dedupe: "defer",
  },
);

provide<Ref<AcademyConfig | null>>("academyConfig", config);

if (error.value) {
  console.error("Erro ao buscar configuração da academia:", error.value);
}

const academyName = computed(() => config.value?.name ?? "Academia");
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
