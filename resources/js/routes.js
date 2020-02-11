import TranslationOverview from "./components/translations/TranslationOverview";

const routes = [
    {path: '/', redirect: '/translations'},
    {path: '/translations', name: 'translations', component: TranslationOverview, meta: {title: 'Translations'}}
];

export default routes;