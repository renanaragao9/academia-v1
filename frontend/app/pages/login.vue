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
  email: "",
  password: "",
});

const isLoading = ref(false);
const errorMessage = ref("");

// ---------------------------------------------------------------------------
// Submissão do formulário
// ---------------------------------------------------------------------------
const handleSubmit = async () => {
  try {
    isLoading.value = true;
    errorMessage.value = "";

    // TODO: Implementar autenticação com backend
    console.log("Login attempt:", formData);

    // Exemplo de redirecionamento após login bem-sucedido
    // await navigateTo('/dashboard')
  } catch (error) {
    errorMessage.value = "Erro ao fazer login. Tente novamente.";
    console.error("Login error:", error);
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
      <!-- Header -->
      <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">Acesse sua conta</h1>
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

      <!-- Mensagem de erro -->
      <div v-if="errorMessage" class="rounded-md bg-red-50 p-4">
        <p class="text-sm font-medium text-red-800">
          {{ errorMessage }}
        </p>
      </div>

      <!-- Formulário de Login -->
      <form @submit.prevent="handleSubmit" class="mt-8 space-y-6">
        <!-- Email -->
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

        <!-- Senha -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">
            Senha
          </label>
          <input
            id="password"
            v-model="formData.password"
            type="password"
            autocomplete="current-password"
            required
            class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            placeholder="••••••••"
          />
        </div>

        <!-- Checkbox Lembrar-se -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember-me"
              type="checkbox"
              class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              Lembrar-se de mim
            </label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
              Esqueceu a senha?
            </a>
          </div>
        </div>

        <!-- Botão de Submissão -->
        <button
          type="submit"
          :disabled="isLoading"
          class="w-full flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <span v-if="!isLoading">Entrar</span>
          <span v-else>Conectando...</span>
        </button>
      </form>

      <!-- Link para Registro -->
      <p class="text-center text-sm text-gray-600">
        Não tem uma conta?
        <NuxtLink
          to="/register"
          class="font-medium text-blue-600 hover:text-blue-500"
        >
          Registre-se agora
        </NuxtLink>
      </p>
    </div>
  </div>
</template>
