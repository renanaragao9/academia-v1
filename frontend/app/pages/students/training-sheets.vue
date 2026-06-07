<script setup lang="ts">
definePageMeta({
  middleware: ["auth"],
  layout: false,
});
</script>

<template>
  <div class="min-h-screen bg-page-default">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
      <div class="flex items-center gap-4 mb-8">
        <NuxtLink
          to="/students"
          class="text-zinc-400 hover:text-white transition-colors"
        >
          <Icon name="lucide:arrow-left" class="h-6 w-6" />
        </NuxtLink>
        <div>
          <h1 class="text-3xl font-bold text-white">Fichas de Treino</h1>
          <p class="text-zinc-400">Visualize e acompanhe seus treinos</p>
        </div>
      </div>

      <div class="card-default text-center py-20">
        <Icon
          name="lucide:dumbbell"
          class="h-16 w-16 text-orange-500 mx-auto mb-4"
        />
        <h2 class="text-xl font-bold text-white mb-2">Em desenvolvimento</h2>
        <p class="text-zinc-400">
          Esta funcionalidade estará disponível em breve
        </p>
      </div>
    </div>
  </div>
</template>
