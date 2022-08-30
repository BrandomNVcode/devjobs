<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li v-for="(skill, i) in this.skills" v-bind:key="i"
                @click="activar($event)"
                class="border border-gray-500 px-10 py-3 rounded mb-4"
                :class="verificarClaseActiva(skill)">{{skill}}</li>
        </ul>

        <input type="hidden" name="skills" id="skills" >
    </div>
</template>

<script>
    export default {
        props: ["skills", "oldskills"],
        data: function() {
            return {
                habilidades: new Set()
            }   
        },
        created() {
            if(this.oldskills) {
                const skillsArr = this.oldskills.split(",");
                skillsArr.forEach(skill => this.habilidades.add(skill));
            }
        },
        mounted() {
            document.querySelector("#skills").value = this.oldskills
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
            },
            verificarClaseActiva(skill) {
                return this.habilidades.has(skill) ? "bg-teal-400" : "";
            }
        }
    }
</script>

