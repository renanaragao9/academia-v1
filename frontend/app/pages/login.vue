<script setup lang="ts">
definePageMeta({
  layout: false,
});

const {
  public: { apiBase },
} = useRuntimeConfig();

type ContactMethod = "email" | "phone";

const formData = reactive({
  code: "",
  contactMethod: "email" as ContactMethod,
  email: "",
  phone: "",
});

const isLoading = ref(false);
const errorMessage = ref("");

const handleSubmit = async () => {
  try {
    isLoading.value = true;
    errorMessage.value = "";

    const payload: Record<string, string> = { code: formData.code };
    if (formData.contactMethod === "email" && formData.email) {
      payload.email = formData.email;
    } else if (formData.contactMethod === "phone" && formData.phone) {
      payload.phone = formData.phone;
    }

    interface StudentResponse {
      data: Record<string, unknown>;
    }

    const response = await $fetch<StudentResponse>(
      `${apiBase}/v1/students/show`,
      {
        method: "POST",
        body: payload,
      },
    );

    if (response?.data) {
      localStorage.setItem("student", JSON.stringify(response.data));
      navigateTo("/students");
    } else {
      errorMessage.value = "Aluno não encontrado. Verifique os dados.";
    }
  } catch {
    errorMessage.value =
      "Não foi possível autenticar. Verifique seu código e contato.";
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-zinc-950 via-zinc-900 to-zinc-950 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="w-full max-w-md space-y-8">
      <div class="text-center">
        <div
          class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 shadow-lg shadow-orange-500/30"
        >
          <Icon name="lucide:dumbbell" class="h-8 w-8 text-white" />
        </div>
        <h1 class="text-3xl font-bold text-white">Acesse sua conta</h1>
        <p class="mt-2 text-sm text-zinc-400">
          Ou
          <NuxtLink
            to="/"
            class="font-medium text-orange-500 hover:text-orange-400 transition-colors"
          >
            volte para a página inicial
          </NuxtLink>
        </p>
      </div>

      <Transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 -translate-y-1"
        leave-active-class="transition duration-150 ease-in"
        leave-to-class="opacity-0 -translate-y-1"
      >
        <div
          v-if="errorMessage"
          class="flex items-start gap-3 rounded-xl border border-red-500/30 bg-red-500/10 p-4"
        >
          <Icon
            name="lucide:alert-circle"
            class="mt-0.5 h-4 w-4 shrink-0 text-red-400"
          />
          <p class="text-sm text-red-400">{{ errorMessage }}</p>
        </div>
      </Transition>

      <form
        class="rounded-2xl border border-white/10 bg-zinc-800/50 p-8 backdrop-blur-sm space-y-6"
        @submit.prevent="handleSubmit"
      >
        <div>
          <label
            for="code"
            class="block text-sm font-medium text-zinc-300 mb-1.5"
          >
            Código do aluno
          </label>
          <input
            id="code"
            v-model="formData.code"
            type="text"
            autocomplete="username"
            required
            class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white placeholder-zinc-600 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500/50 transition-colors"
            placeholder="Ex: ALU-0001"
          />
        </div>

        <div>
          <p class="block text-sm font-medium text-zinc-300 mb-2">
            Confirmar identidade via
          </p>
          <div class="flex rounded-xl border border-zinc-700 bg-zinc-900 p-1">
            <button
              type="button"
              :class="[
                'flex-1 rounded-lg py-2 text-sm font-medium transition-all',
                formData.contactMethod === 'email'
                  ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow'
                  : 'text-zinc-400 hover:text-white',
              ]"
              @click="formData.contactMethod = 'email'"
            >
              E-mail
            </button>
            <button
              type="button"
              :class="[
                'flex-1 rounded-lg py-2 text-sm font-medium transition-all',
                formData.contactMethod === 'phone'
                  ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow'
                  : 'text-zinc-400 hover:text-white',
              ]"
              @click="formData.contactMethod = 'phone'"
            >
              Telefone
            </button>
          </div>
        </div>

        <div v-if="formData.contactMethod === 'email'">
          <label
            for="email"
            class="block text-sm font-medium text-zinc-300 mb-1.5"
          >
            E-mail
          </label>
          <input
            id="email"
            v-model="formData.email"
            type="email"
            autocomplete="email"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white placeholder-zinc-600 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500/50 transition-colors"
            placeholder="seu@email.com"
          />
        </div>

        <div v-else>
          <label
            for="phone"
            class="block text-sm font-medium text-zinc-300 mb-1.5"
          >
            Telefone
          </label>
          <input
            id="phone"
            v-model="formData.phone"
            type="tel"
            autocomplete="tel"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white placeholder-zinc-600 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500/50 transition-colors"
            placeholder="(11) 99999-9999"
          />
        </div>

        <button
          type="submit"
          :disabled="isLoading"
          class="group w-full flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-red-600 py-3 px-4 text-sm font-semibold text-white hover:shadow-xl hover:shadow-orange-500/30 hover:scale-[1.02] transition-all duration-300 disabled:opacity-60 disabled:scale-100 disabled:cursor-not-allowed"
        >
          <Icon
            v-if="isLoading"
            name="lucide:loader-2"
            class="h-4 w-4 animate-spin"
          />
          <span>{{ isLoading ? "Autenticando..." : "Entrar" }}</span>
        </button>
      </form>
    </div>
  </div>
</template>
