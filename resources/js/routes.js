import ItemList from "./components/items/ItemList";
import LoginForm from './components/users/LoginForm';
import RegisterForm from "./components/users/RegisterForm";
import ItemCreateForm from "./components/items/ItemCreateForm";

export default [
    {path: '/', name:'home', component: ItemList},
    {path: '/login', name: 'login', component: LoginForm},
    {path: '/register', name: 'register', component: RegisterForm},
    {path: '/items', name: 'items', component: ItemList},
    {path: '/items/create', name: 'item-create', component: ItemCreateForm}
];
