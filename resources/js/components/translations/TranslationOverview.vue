<template>
    <div id="translations">
        <h1>Translations</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ 'translation.key' | translate }}</th>
                    <th v-for="languages in adminLanguages">{{ `language.${language}` | translate }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="translation in translations">
                    <td>{{ translation.key }}</td>
                    <td v-if="adminLanguages.includes(language.key)"
                        v-for="language in translation.languages">
                        {{ language.key | truncate }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";

    export default {
        name: "TranslationOverview",
        created() {
            this.$store.dispatch('translations/getLanguages');
            this.$store.dispatch('translations/get');
        },
        computed: {
            ...mapState('translations', ['translations', 'languages']),
            ...mapGetters('translations', ['adminLanguages']),
        }
    }
</script>