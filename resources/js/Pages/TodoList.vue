<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
export default {
  props: {
    tasks: Array,
    errors: Object
  },
  components: {
    AuthenticatedLayout,
    Head
  },
  data() {
    return {
      form: {
        title: '',
        description: '',
        priority: '',
      }
    }
  },
  methods: {
    addTask() {
      router.post('/todo', this.form, {
        onSuccess: () => {
          this.form.title = '';
          this.form.description = '';
          this.form.priority = '';
        }
      });
    },
    deleteTask(id) {
      router.delete(`/todo/${id}`);
    },
    toggleComplete(task) {
      router.put(`/todo/${task.id}`, {
        ...task,
        completed: !task.completed
      });
    },
    goToPage(page) {
      router.get('/todo', { page });
    }
  }
}
</script>

<template>
  <Head title="To-Do List" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">To-Do List</h2>
    </template>
    <div class="py-12">
      <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row gap-8">
        <div class="md:w-1/2">
          <h2 class="text-3xl font-extrabold mb-6 text-blue-700 text-center flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6" /></svg>
            My To-Do List
          </h2>
          <form @submit.prevent="addTask" class="mb-8 flex flex-col gap-4 bg-gray-50 p-6 rounded-lg shadow">
            <input v-model="form.title" type="text" placeholder="Task Title" class="border-2 border-blue-200 focus:border-blue-500 rounded px-3 py-2 transition outline-none" required />
            <span v-if="errors && errors.title" class="text-red-500 text-sm">{{ errors.title }}</span>
            <textarea v-model="form.description" placeholder="Description" class="border-2 border-blue-200 focus:border-blue-500 rounded px-3 py-2 transition outline-none"></textarea>
            <span v-if="errors && errors.description" class="text-red-500 text-sm">{{ errors.description }}</span>
            <select v-model="form.priority" class="border-2 border-blue-200 focus:border-blue-500 rounded px-3 py-2 transition outline-none">
              <option disabled value="">Priority</option>
              <option value="1">Low</option>
              <option value="2">Medium</option>
              <option value="3">High</option>
            </select>
            <span v-if="errors && errors.priority" class="text-red-500 text-sm">{{ errors.priority }}</span>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow hover:scale-105 transition">Add Task</button>
          </form>
        </div>
        <div class="md:w-1/2">
          <ul class="divide-y divide-gray-200">
            <li v-for="task in tasks.data" :key="task.id" class="flex items-center justify-between py-4">
              <div>
                <span :class="{'line-through text-gray-400': task.completed, 'font-bold text-lg': !task.completed}" class="transition">{{ task.title }}</span>
                <span class="ml-2 text-xs px-2 py-1 rounded bg-blue-100 text-blue-700 font-semibold">
                  Priority:
                  <span>
                    {{ task.priority == 1 ? 'Low' : (task.priority == 2 ? 'Medium' : (task.priority == 3 ? 'High' : task.priority)) }}
                  </span>
                </span>
                <div class="text-sm text-gray-600 mt-1">{{ task.description }}</div>
              </div>
              <div class="flex gap-2">
                <button @click="toggleComplete(task)" class="bg-green-100 text-green-700 px-3 py-1 rounded hover:bg-green-200 font-medium shadow">{{ task.completed ? 'Undo' : 'Complete' }}</button>
                <button @click="deleteTask(task.id)" class="bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200 font-medium shadow">Delete</button>
              </div>
            </li>
          </ul>
          <div v-if="tasks.data.length === 0" class="text-center text-gray-400 mt-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6" /></svg>
            No tasks yet. Add your first task!
          </div>
          <div v-if="tasks.last_page > 1" class="flex justify-center mt-6 gap-2">
            <button v-if="tasks.current_page > 1" @click="goToPage(tasks.current_page - 1)" class="px-3 py-1 rounded bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200">Prev</button>
            <span class="px-3 py-1 rounded bg-gray-100 text-gray-700">Page {{ tasks.current_page }} of {{ tasks.last_page }}</span>
            <button v-if="tasks.current_page < tasks.last_page" @click="goToPage(tasks.current_page + 1)" class="px-3 py-1 rounded bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200">Next</button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
</style>
