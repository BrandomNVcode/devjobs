<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li v-for="(skill, i) in this.skills" v-bind:key="i"
                @click="activar($event)"
                class="border border-gray-500 px-10 py-3 rounded mb-4">{{skill}}</li>
        </ul>

        <input type="hidden" name="skills" id="skills">
    </div>
</template>

<script>
    export default {
        props: ["skills"],
        data: function() {
            return {
                habilidades: new Set()
            }   
        },
        mounted() {
            //console.log(this.skills)
        },
        methods: {
            activar(e) {
                if(e.target.classList.contains("bg-teal-400")) { // si esta activo
                    e.target.classList.remove("bg-teal-400");  
                    // Eliminar del set de habilidades
                    this.habilidades.delete(e.target.textContent);  
                } else {
                    e.target.classList.add("bg-teal-400");

                    // Agregar al set de habilidades
                    this.habilidades.add(e.target.textContent);
                }
                const stringHab = [... this.habilidades];
                document.querySelector("#skills").value = stringHab;
            }
        }
    }
</script>

