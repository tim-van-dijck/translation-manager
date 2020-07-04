import TranslationForm from "./components/translations/TranslationForm";
import TranslationOverview from "./components/translations/TranslationOverview";

const routes = [
    {path: '/', redirect: '/translations'},
    {path: '/translations', name: 'translations', component: TranslationOverview, meta: {title: 'Translations'}},
    {path: '/translations/:key/edit', name: 'translations-edit', component: TranslationForm, meta: {title: 'Edit translation'}}
];

export default routes;