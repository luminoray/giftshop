import Home from "./components/Home";
import ItemList from "./components/items/ItemList";
import LoginForm from './components/users/LoginForm';
import RegisterForm from "./components/users/RegisterForm";
import ItemForm from "./components/items/ItemForm";
import ItemDetails from "./components/items/ItemDetails";
import ItemCart from "./components/items/ItemCart";

export default [
    {path: '/', name:'home', component: Home},
    {path: '/login', name: 'login', component: LoginForm},
    {path: '/register', name: 'register', component: RegisterForm},
    {path: '/items', name: 'items', component: ItemList},
    {path: '/items/create', name: 'item-create', component: ItemForm},
    {path: '/items/:id', name: 'item-detail', component: ItemDetails, props: true},
    {path: '/items/:id/edit', name: 'item-edit', component: ItemForm, props: true},
    {path: '/cart', name: 'cart', component: ItemCart, props: true}
];
