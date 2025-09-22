<template>
    <div class="bg-white border border-gray-200 p-10 rounded-3xl shadow-2xl w-full  mx-4">
      <!-- Header section -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mb-3">
          Welcome!
        </h1>
        <p class="text-lg text-gray-600 font-medium">Choose your productivity tool</p>
      </div>

      <!-- Buttons section -->
      <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <button
          @click="goToTodo"
          class="group flex-1 relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-4 px-6 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl border border-blue-400/20 overflow-hidden"
        >
          <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
          <div class="relative flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            <span>To-Do List</span>
          </div>
        </button>

        <button
          @click="goToPoll"
          class="group flex-1 relative bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white py-4 px-6 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl border border-emerald-400/20 overflow-hidden"
        >
          <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
          <div class="relative flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Poll Creator</span>
          </div>
        </button>
      </div>

      <!-- Footer -->
      <div class="text-center">
        <p class="text-sm text-gray-500">Select an application to get started</p>
      </div>
    </div>
</template>

<script>
export default {
  name: 'Menu',
  methods: {
    goToTodo() {
      this.$inertia.visit('/todo');
    },
    goToPoll() {
      this.$inertia.visit('/poll');
    }
  }
}
</script>

<style scoped>
.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

/* Custom responsive breakpoints */
@media (max-width: 640px) {
  .flex-col.sm\:flex-row {
    flex-direction: column;
  }
}

@media (min-width: 640px) {
  .flex-col.sm\:flex-row {
    flex-direction: row;
  }
}

/* Ensure no scrolling on mobile */
@media (max-height: 600px) {
  .min-h-screen {
    min-height: 100vh;
    height: 100vh;
  }

  .bg-white\/10 {
    padding: 1.5rem;
  }

  h1 {
    font-size: 2rem;
    margin-bottom: 0.75rem;
  }

  .w-20.h-20 {
    width: 4rem;
    height: 4rem;
  }

  .w-10.h-10 {
    width: 2rem;
    height: 2rem;
  }
}
</style>
