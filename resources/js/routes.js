import ItemList from "./components/items/ItemList";
import LoginForm from './components/users/LoginForm';
import RegisterForm from "./components/users/RegisterForm";
import ItemForm from "./components/items/ItemForm";
import ItemDetails from "./components/items/ItemDetails";

export default [
    {path: '/', name:'home', component: ItemList},
    {path: '/login', name: 'login', component: LoginForm},
    {path: '/register', name: 'register', component: RegisterForm},
    {path: '/items', name: 'items', component: ItemList},
    {path: '/items/create', name: 'item-create', component: ItemForm},
    {path: '/items/:id', name: 'item-detail', component: ItemDetails, props: true},
    {path: '/items/:id/edit', name: 'item-edit', component: ItemForm, props: true}
];
