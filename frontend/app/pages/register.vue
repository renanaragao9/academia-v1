<script setup lang="ts">
// ---------------------------------------------------------------------------
// Layout
// ---------------------------------------------------------------------------
definePageMeta({
  layout: "default",
});

// ---------------------------------------------------------------------------
// Estado do formulário
// ---------------------------------------------------------------------------
const formData = reactive({
  name: "",
  email: "",
  password: "",
  passwordConfirm: "",
});

const isLoading = ref(false);
const errorMessage = ref("");
const successMessage = ref("");

// ---------------------------------------------------------------------------
// Validação de senha
// ---------------------------------------------------------------------------
const passwordsMatch = computed(() => {
  return (
    formData.password === formData.passwordConfirm &&
    formData.password.length >= 8
  );
});

// ---------------------------------------------------------------------------
// Submissão do formulário
// ---------------------------------------------------------------------------
const handleSubmit = async () => {
  try {
    if (!passwordsMatch.value) {
      errorMessage.value =
        "As senhas não correspondem ou têm menos de 8 caracteres.";
      return;
    }

    isLoading.value = true;
    errorMessage.value = "";
    successMessage.value = "";

    // TODO: Implementar registro com backend
    console.log("Register attempt:", {
      name: formData.name,
      email: formData.email,
    });

    successMessage.value =
      "Registro realizado com sucesso! Redirecionando para login...";

    // Aguardar 2 segundos e redirecionar para login
    setTimeout(() => {
      navigateTo("/login");
    }, 2000);
  } catch (error) {
    errorMessage.value = "Erro ao registrar. Tente novamente.";
    console.error("Register error:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="w-full max-w-md space-y-8">
      <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">Crie sua conta</h1>
        <p class="mt-2 text-sm text-gray-600">
          Ou
          <NuxtLink
            to="/"
            class="font-medium text-blue-600 hover:text-blue-500"
          >
            volte para a página inicial
          </NuxtLink>
        </p>
      </div>

      <div v-if="errorMessage" class="rounded-md bg-red-50 p-4">
        <p class="text-sm font-medium text-red-800">
          {{ errorMessage }}
        </p>
      </div>

      <div v-if="successMessage" class="rounded-md bg-green-50 p-4">
        <p class="text-sm font-medium text-green-800">
          {{ successMessage }}
        </p>
      </div>

      <form @submit.prevent="handleSubmit" class="mt-8 space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">
            Nome Completo
          </label>
          <input
            id="name"
            v-model="formData.name"
            type="text"
            autocomplete="name"
            required
            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            placeholder="Seu nome"
          />
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">
            E-mail
          </label>
          <input
            id="email"
            v-model="formData.email"
            type="email"
            autocomplete="email"
            required
            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            placeholder="seu@email.com"
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">
            Senha (mínimo 8 caracteres)
          </label>
          <input
            id="password"
            v-model="formData.password"
            type="password"
            autocomplete="new-password"
            required
            minlength="8"
            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            placeholder="••••••••"
          />
        </div>

        <div>
          <label
            for="password-confirm"
            class="block text-sm font-medium text-gray-700"
          >
            Confirmar Senha
          </label>
          <input
            id="password-confirm"
            v-model="formData.passwordConfirm"
            type="password"
            autocomplete="new-password"
            required
            minlength="8"
            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            placeholder="••••••••"
          />
          <p
            v-if="formData.password && !passwordsMatch"
            class="mt-1 text-sm text-red-600"
          >
            As senhas não correspondem
          </p>
        </div>

        <div class="flex items-center">
          <input
            id="terms"
            type="checkbox"
            required
            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
          />
          <label for="terms" class="ml-2 block text-sm text-gray-900">
            Concordo com os
            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
              Termos de Serviço
            </a>
          </label>
        </div>

        <button
          type="submit"
          :disabled="isLoading || !passwordsMatch"
          class="w-full flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <span v-if="!isLoading">Registrar</span>
          <span v-else>Registrando...</span>
        </button>
      </form>

      <p class="text-center text-sm text-gray-600">
        Já tem uma conta?
        <NuxtLink
          to="/login"
          class="font-medium text-blue-600 hover:text-blue-500"
        >
          Faça login
        </NuxtLink>
      </p>
    </div>
  </div>
</template>
