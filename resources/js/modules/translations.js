import axios from 'axios';

export const translations = {
    namespaced: true,
    state: {
        page: 1,
        translations: {},
        languages: null
    },
    actions: {
        get({state, commit}) {
            axios.get(`/translations?page[number]=${state.page || 1}`)
                .then((response) => {
                    commit('SET_TRANSLATIONS', response.data.data);
                })
        },
        async find({dispatch, state}, key) {
            if (state.translations.length === 0) {
                await dispatch('get');
            }
            return state.translations.find((trans) => {
                return trans.key == key;
            });
        },
        create({commit}, data) {
            return axios.post('/translations', data)
                .then((translation) => {
                    commit('ADD_TRANSLATION', translation);
                });
        },
        update({commit}, data) {
            return axios.put(`/translations/${data.key}`, data.translation)
                .then((translation) => {
                    commit('UPDATE_TRANSLATION', translation);
                });
        },
        destroy({commit}, key) {
            return axios.delete(`/translations/${key}`)
                .then(() => {
                    commit('DELETE_TRANSLATION', key);
                });
        },
        getLanguages({commit}) {
            axios.get(`/languages`)
                .then((response) => {
                    commit('SET_LANGUAGES', response.data.data);
                });
        }
    },
    mutations: {
        SET_LANGUAGES(state, languages) {
            state.languages = languages;
        },
        SET_TRANSLATIONS(state, translations) {
            state.translations = translations;
        },
        ADD_TRANSLATION(state, translation) {
            state.translations.push(translation);
        },
        UPDATE_TRANSLATION(state, translation) {
            let index = state.translations.findIndex((item) => {return item.key = translation.key});
            state.translations.splice(index, 1, translation);
        },
        DELETE_TRANSLATION(state, key) {
            let index = state.translations.findIndex((item) => {return item.key = key});
            if (index >= 0) {
                state.translations.splice(index, 1);
            }
        }
    },
    getters: {
        adminLanguages(state) {
            if (state.languages == null) {
                return [];
            }
            return state.languages.filter((item) => {
                return item.admin == 1;
            });
        }
    }
};