import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default function useCategories() {
    const router = useRouter();
    const categories = ref([]);
    const categoryOptions = ref([]);

    const getCategories = async() => {
        const response = await axios.get('/api/categories');
        categories.value = response.data;
    }
    const getCategoriesDropdown = async() => {
        const response = await axios.get('/api/categories');
        categoryOptions.value = response.data.map((c) => {
            return {
                name: c.name,
                value: c.id,
            }
        });
    }

    const storeCategory = async(data) => {
        await axios.post('/api/categories', data);
        await router.push({ name: 'category.index' });
    }
    return {
        categories,
        getCategories,
        storeCategory,
        categoryOptions,
        getCategoriesDropdown
    }
}