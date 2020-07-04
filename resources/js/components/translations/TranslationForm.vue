<template>
    <form action="">
        <h1>{{ 'translations.edit' | translate }}</h1>
        <router-link tag="button" class="btn btn-secondary" :to="{name: 'translations'}">
            « Back
        </router-link>
        <div class="form-group">
            <label for="key">{{ 'translation.key' | translate }}</label>
            <input id="key" type="text" class="form-control">
        </div>
        <button type="button" class="btn btn-green" @click.prevent="save">{{ 'system.save' | translate }}</button>
        <a href="" class="btn btn-outline-danger">{{ 'system.cancel' | translate }}</a>
    </form>
</template>

<script>
    export default {
        name: "TranslationForm"
    }
</script>