<template>
    <div id="translations" v-if="Object.keys(trans).length > 0">
        <h1>{{ 'translation.title' | translate }}</h1>
        <p>
            <button class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>
                    {{ 'system.add' | translate }}
                </span>
            </button>
        </p>
        <table v-if="adminLanguages.length > 0" class="table table-striped">
            <thead>
                <tr>
                    <th class="table-cell--shrink"></th>
                    <th class="table-cell--shrink"></th>
                    <th>{{ 'translation.key' | translate }}</th>
                    <th v-for="language in adminLanguages">{{ language.name | translate }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="translation in translations">
                    <td>
                        <router-link :to="{name: 'translations-edit', params: {key: translation.key}}">
                            <i class="fas fa-pencil-alt"></i>
                        </router-link>
                    </td>
                    <td>
                        <a href="#" @click.prevent=""><i class="fas fa-trash"></i></a>
                    </td>
                    <td>{{ translation.key }}</td>
                    <td v-for="language in adminLanguages">
                        {{ translation.languages[language.key] | truncate }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p v-else class="text-center">
        <i class="fas fa-cog fa-2x fa-spin"></i>
    </p>
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
            ...mapState(['trans']),
            ...mapGetters('translations', ['adminLanguages']),
            loaded() {
                return this.languages != null;
            }
        }
    }
</script>
