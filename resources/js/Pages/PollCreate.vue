<template>
  <Head title="Create Poll" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-3xl font-extrabold mb-6 text-indigo-700 text-center">Create a Poll</h2>
    </template>
    <div class="min-h-screen flex flex-col md:flex-row items-start justify-start pt-8 p-0 gap-8">
      <!-- Poll Form Section - Starts from exact left -->
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 p-8 w-full max-w-md md:w-1/3 ml-8 ">
        <!-- Header -->
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mb-4 shadow-lg">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
          </div>
          <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
            Create Your Poll
          </h1>
          <p class="text-gray-600">Gather opinions and make decisions together</p>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
          <!-- Question Input -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Poll Question
            </label>
            <div class="relative">
              <input
                v-model="form.question"
                type="text"
                placeholder="What would you like to ask?"
                class="w-full border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-xl px-4 py-3 transition-all duration-200 outline-none bg-white/50 backdrop-blur-sm text-gray-800 placeholder-gray-500"
              />
              <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <span v-if="errors && errors.question" class="text-red-500 text-sm font-medium flex items-center gap-1">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ errors.question }}
            </span>
          </div>

          <!-- Options Section -->
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <label class="text-sm font-semibold text-gray-700">
                Answer Options
              </label>
              <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                {{ form.options.length }}/10 options
              </span>
            </div>

            <div class="space-y-3">
              <div
                v-for="(option, idx) in form.options"
                :key="idx"
                class="group relative"
              >
                <div class="flex items-center gap-3">
                  <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold text-sm">
                    {{ String.fromCharCode(65 + idx) }}
                  </div>
                  <input
                    v-model="form.options[idx]"
                    type="text"
                    :placeholder="`Option ${String.fromCharCode(65 + idx)}`"
                    class="flex-1 border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-xl px-4 py-3 transition-all duration-200 outline-none bg-white/50 backdrop-blur-sm"
                  />
                  <button
                    v-if="form.options.length > 2"
                    type="button"
                    @click="removeOption(idx)"
                    class="flex-shrink-0 w-8 h-8 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-all duration-200 flex items-center justify-center group-hover:opacity-100 opacity-60"
                    title="Remove option"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Error Messages -->
            <div class="space-y-1">
              <span v-if="errors && errors.options" class="text-red-500 text-sm font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ errors.options }}
              </span>
              <span v-if="errors && errors['options.0']" class="text-red-500 text-sm font-medium">{{ errors['options.0'] }}</span>
              <span v-if="errors && errors['options.1']" class="text-red-500 text-sm font-medium">{{ errors['options.1'] }}</span>
            </div>

            <!-- Add Option Button -->
            <button
              type="button"
              @click="addOption"
              :disabled="form.options.length >= 10"
              class="flex items-center gap-2 bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 px-4 py-2 rounded-xl hover:from-indigo-100 hover:to-purple-100 font-medium transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed border-2 border-indigo-200 hover:border-indigo-300"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Add Option
            </button>
          </div>

          <!-- Submit Button -->
          <div class="pt-6">
            <button
              type="submit"
              class="w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 text-lg"
            >
              <span class="flex items-center justify-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Create Poll
              </span>
            </button>
          </div>
        </form>

        <!-- Success Message -->
        <div v-if="success" class="mt-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl">
          <div class="text-center">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <p class="text-green-800 font-semibold mb-2">{{ success }}</p>
            <p class="text-green-700 text-sm mb-4">Share this link with others to collect responses:</p>
            <div class="flex items-center gap-2 p-3 bg-white/80 rounded-lg border border-green-200">
              <input
                :value="pollLink"
                readonly
                class="flex-1 bg-transparent border-none outline-none text-sm text-gray-700 font-mono"
              />
              <button
                @click="copyLink"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 text-sm font-medium flex items-center gap-1"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Copy
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- User Polls Section - Larger width -->
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 p-6 w-full md:w-2/3 mr-4 md:mr-0">
        <h2 class="text-xl font-bold mb-3 text-indigo-700">Your Polls</h2>
        <div v-if="polls.data.length === 0" class="text-gray-400 text-sm">No polls yet.</div>
        <ul v-else class="space-y-3">
          <li v-for="poll in polls.data" :key="poll.id" class="bg-white rounded-lg shadow-sm p-3 border border-indigo-100">
            <div class="flex items-start justify-between gap-4">
              <!-- Left side: Question and options -->
              <div class="flex-1 min-w-0">
                <div class="font-semibold text-base text-indigo-700 mb-2 truncate">{{ poll.question }}</div>
                <div class="flex gap-1 flex-wrap mb-2">
                  <span v-for="opt in JSON.parse(poll.options)" :key="opt" class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded text-xs whitespace-nowrap">{{ opt }}</span>
                </div>
              </div>

              <!-- Right side: Actions -->
              <div class="flex flex-col gap-1 flex-shrink-0">
                <a :href="`/poll/results/${poll.token}`" class="bg-green-100 text-green-700 px-3 py-1 rounded hover:bg-green-200 font-medium shadow text-xs text-center">View Results</a>
                <button @click="copyPollLink(poll.token)" :class="['bg-indigo-100 text-indigo-700 px-3 py-1 rounded font-medium shadow transition-all text-xs', copiedToken === poll.token ? 'bg-green-200 text-green-700 scale-105' : 'hover:bg-indigo-200']">
                  <span v-if="copiedToken === poll.token">Copied!</span>
                  <span v-else>Copy Link</span>
                </button>
              </div>
            </div>

            <!-- Poll link at bottom -->
            <div class="text-xs text-gray-500 mt-2 truncate">
              <span class="font-mono">{{ getPollLink(poll.token) }}</span>
            </div>
          </li>
        </ul>
        <div v-if="polls.last_page > 1" class="flex justify-center mt-4 gap-2">
          <button v-if="polls.current_page > 1" @click="goToPage(polls.current_page - 1)" class="px-3 py-1 rounded bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 text-sm">Prev</button>
          <span class="px-3 py-1 rounded bg-gray-100 text-gray-700 text-sm">Page {{ polls.current_page }} of {{ polls.last_page }}</span>
          <button v-if="polls.current_page < polls.last_page" @click="goToPage(polls.current_page + 1)" class="px-3 py-1 rounded bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 text-sm">Next</button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
export default {
  props: {
    errors: Object,
    poll: Object,
    success: String,
    polls: Object
  },
  components: { AuthenticatedLayout, Head },
  data() {
    return {
      form: {
        question: '',
        options: ['', '']
      },
      pollLink: '',
      copiedToken: null,
    }
  },
  methods: {
    addOption() {
      if (this.form.options.length < 10) this.form.options.push('');
    },
    removeOption(idx) {
      if (this.form.options.length > 2) this.form.options.splice(idx, 1);
    },
    submit() {
      router.post('/poll', this.form, {
        onSuccess: (page) => {
          if (page.props.success && page.props.poll) {
            this.pollLink = `/poll/vote/${page.props.poll.token}`;
           
          }
        }
      });
    },
    copyLink() {
      navigator.clipboard.writeText(window.location.origin + this.pollLink);
    },
    getPollLink(token) {
      return (typeof window !== 'undefined' ? window.location.origin : '') + '/poll/vote/' + token;
    },
    copyPollLink(token) {
      navigator.clipboard.writeText(this.getPollLink(token));
      this.copiedToken = token;
      setTimeout(() => {
        this.copiedToken = null;
      }, 1200);
    },
    goToPage(page) {
      router.get('/poll/create', { page });
    }
  }
}
</script>

<style scoped>
/* Custom scrollbar for better aesthetics */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 3px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #6366f1, #8b5cf6);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #4f46e5, #7c3aed);
}

/* Subtle animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.space-y-3 > div {
  animation: fadeInUp 0.3s ease-out;
}

/* Focus states for better accessibility */
input:focus,
button:focus {
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Hover effects for interactive elements */
.group:hover input {
  border-color: #a5b4fc;
}

/* Gradient text effect */
.bg-clip-text {
  -webkit-background-clip: text;
  background-clip: text;
}
</style>
