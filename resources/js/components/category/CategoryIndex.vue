<template>
  <div class="flex justify-between mb-2">
    <h1 class="text-2xl font-bold">
      Categories
    </h1>
    <router-link :to="{name:'category.create'}" class="p-2 transition-colors duration-700 transform bg-indigo-500 hover:bg-blue-400 text-gray-100 text-sm rounded-lg focus:border-4 border-indigo-300">
          Add
    </router-link>
  </div>


    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
      <table class="min-w-max w-full table-auto">
        <thead>
          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-2 px-2 text-left">Image</th>
            <th class="py-2 px-2 text-left">Name</th>
            <th class="py-2 px-2 text-left">Parent</th>
            <th class="py-2 px-2 text-center">Status</th>
            <th class="py-2 px-2 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-900 text-sm font-light">
          <template v-for="(item, index) in categories" :key="index">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="py-2 px-2 text-left whitespace-nowrap">
                <img v-if="item.image" :src="'/uploads/category/' + item.image" class="w-20 rounded ">
                <img v-if="!item.image" src="/images/no-image.png" class="w-20 rounded ">
                </td>
              <td class="py-2 px-2 text-left whitespace-nowrap">{{ item.name }}</td>
              <td class="py-2 px-2 text-left whitespace-nowrap">{{ item.parent_category_name ? item.parent_category_name :"None" }}</td>
              <td class="py-2 px-2 text-center whitespace-nowrap">
                  <Status :status="item.status" />
                </td>
              <td class="py-2 px-2 text-center whitespace-nowrap">
                <div class="flex item-center justify-center">
                  <router-link to="" class="no-underline w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                      <img src="/images/view-icon.svg" alt="View" />
                  </router-link>
                  <router-link :to="{name:'category.edit', params: {id:item.id}}"  class="no-underline w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                      <img src="/images/edit-icon.svg" alt="Edit" />
                  </router-link>
                  <button type="button" @click="destroyCategory(item.id)" class="no-underline w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                      <img src="/images/delete-icon.svg" alt="Delete" />
                  </button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>

    </div>
  </div>
  <confirm-delete v-model:itemId.sync="item_id" v-show="showModal" modalHeadline="Delete customers?" deleteMessage="Are you sure?" @deleteRecordEvent="deleteCustomers" @close="togglePopup" ></confirm-delete>
  <!-- <div v-show="showModal" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover" id="modal-id">
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>

    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <div class="text-center p-5 flex-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <h2 class="text-xl font-bold py-4 ">Are you sure?</h2>
            <p class="text-sm text-gray-500 px-8">Do you really want to delete your account? This process cannot be undone</p>
        </div>
        <div class="p-3  mt-2 text-center space-x-4 md:block">
            <button @click="togglePopup" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                Cancel
            </button>
            <button class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
        </div>
    </div>
  </div> -->
</template>

<script>
import { computed, onMounted, ref, watch } from 'vue';
import useCategories from '../../composables/category';
import Status from '../common/Status';
import ConfirmDelete from '../common/ConfirmDelete';

export default {
    components: {
        Status,
        ConfirmDelete
    },
    setup(props) {
        const showModal = ref(false);
        const item_id = ref(0);
        
        const { categories, getCategories} = useCategories();

        onMounted(getCategories);

        const destroyCategory = async (id) => {
          item_id.value = id;
          togglePopup();
        }
        const togglePopup = async () => {
            showModal.value = !showModal.value;
        }
        const deleteCustomers = (e) => {
          console.log("goodbye", e);
          togglePopup()
        }

        watch(item_id, (item, prevItem) => { 
            console.log(item, prevItem);
        })
        return {
            item_id,
            showModal,
            categories,
            destroyCategory,
            togglePopup,
            deleteCustomers
        }        
    },
}
</script>