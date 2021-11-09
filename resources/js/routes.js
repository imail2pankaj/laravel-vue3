import AnotherComponent from './components/AnotherComponent.vue';
import Dashboard from './components/Dashboard.vue';
import Category from './components/category/CategoryIndex.vue';
import CategoryCreate from './components/category/CategoryCreate.vue';
import Product from './components/product/ProductIndex.vue';
import Company from './components/company/CompanyIndex.vue';
import CompanyCreate from './components/company/CompanyCreate.vue';
import CompanyEdit from './components/company/CompanyEdit.vue';
import UserProfile from './user/components/UserProfile.vue';

export default {
    routes: [{
            path: '/app/dashboard',
            component: Dashboard,
            name: 'dashboard',
            meta: {
                title: 'Dashboard',
                primary: true
            },
        },
        {
            path: '/app/another-component',
            component: AnotherComponent,
            name: 'another-component',
            meta: {
                title: 'Another Component',
                primary: true
            },
        },
        {
            path: '/app/categories',
            component: Category,
            name: 'category.index',
            meta: {
                title: 'Category',
                primary: true
            },
        },
        {
            path: '/app/categories/create',
            component: CategoryCreate,
            name: 'category.create',
            meta: {
                title: 'Category Create',
                primary: false
            },
        },
        {
            path: '/app/products',
            component: Product,
            name: 'product.index',
            meta: {
                title: 'Products',
                primary: true
            },
        },
        {
            path: '/app/company',
            component: Company,
            name: 'company',
            meta: {
                title: 'Company',
                primary: true
            },
        },
        {
            path: '/app/company/create',
            component: CompanyCreate,
            name: 'company.create',
            meta: {
                title: 'Company',
                primary: false
            },
        },
        {
            path: '/app/company/:id/edit',
            component: CompanyEdit,
            name: 'company.edit',
            props: true,
            meta: {
                title: 'Company',
                primary: false
            },
        },
        {
            path: '/app/user-profile',
            component: UserProfile,
            name: 'user-profile',
            meta: {
                title: 'User Profile',
                primary: false
            },
        },
    ],
};