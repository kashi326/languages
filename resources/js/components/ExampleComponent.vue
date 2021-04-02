<template>
    <Home />
</template>

<script>
import Home from "./pages/Home";
export default {
    components: { Home },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
