<template>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Translation Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-content">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" :class="{active: true}">
                    <router-link class="nav-link" :to="{name: 'translations'}">Translations <span class="sr-only">(current)</span></router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Apps</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>