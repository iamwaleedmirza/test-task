<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-yellow-100 to-pink-100">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-lg">
      <h2 class="text-2xl font-bold mb-6 text-pink-700 text-center">Poll Results</h2>
      <div class="mb-4 text-lg text-center font-semibold">{{ poll.question }}</div>
      <div v-if="total === 0" class="text-gray-400 text-center">No votes yet.</div>
      <div v-else>
        <div v-for="(count, option) in results" :key="option" class="mb-4">
          <div class="flex justify-between items-center">
            <span class="font-medium">{{ option }}</span>
            <span class="font-bold text-pink-700">{{ count }} votes</span>
          </div>
          <div class="w-full bg-pink-100 rounded h-4 mt-2">
            <div :style="{ width: ((count/total)*100) + '%' }" class="bg-pink-500 h-4 rounded"></div>
          </div>
        </div>
        <div class="mt-6 text-center text-lg font-semibold">Total Votes: {{ total }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    poll: Object,
    results: Object,
    total: Number
  }
}
</script>

<style scoped>
</style>
