<template>
    <v-app>
        <Header />
        <v-main>
            <v-container>
                <h1>Hello world</h1>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Header from "../../common/Header";
export default {
    components: { Header }
};
</script>
