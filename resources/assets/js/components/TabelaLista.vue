<template>
<div>    
    <div class="form-inline">
        <a v-if="criar" v-binf:href="criar">Criar</a>
        <div class="form-group pull-right">
            <input type="search" class="form-control" placeholder="Buscar..." v-model="buscar">
        </div>
    </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th v-bind:key="titulo" v-for="titulo in titulos">{{titulo}}</th>
                <th  v-if="detalhe || editar || deletar">Ações</th>
                </tr>
            </thead>
            <tbody>
            <tr v-bind:key="iten[0][0]" v-for="(iten, index) in lista">
                <td v-bind:key="i" v-for="i in iten">{{i}}</td>                

                <td  v-if="detalhe || editar || deletar">
                    <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" v-bind:value="token" />
                        <a v-if="detalhe" v-bind:href="detalhe">Detalhar</a>  
                        <a v-if="editar" v-bind:href="editar">| Editar</a>                          
                        <a href="#" v-on:click="executaForm(index)">| Deletar</a>
                    </form>
                    <span v-if="!token">
                        <a v-if="detalhe" v-bind:href="detalhe">Detalhar </a>  
                        <a v-if="editar" v-bind:href="editar">| Editar </a>  
                        <a v-if="deletar" v-bind:href="deletar">| Deletar</a>
                    </span>
                     <span v-if="token && !deletar">
                        <a v-if="detalhe" v-bind:href="detalhe">Detalhar</a>  
                        <a v-if="editar" v-bind:href="editar">| Editar</a>  
                    </span>

                    
                   
                </td>

            </tr>            
            
            </tbody>
        </table>
</div>
</template>

<script>
export default {
  props: ["titulos", "itens", "criar", "detalhe", "editar", "deletar", "token", "ordem", "ordemcol"],
  methods: {
    executaForm: function(index) {
      document.getElementById(index).submit();
    }
  },
  data: function() {
    return {
      buscar: ""
    };
  },
  computed: {
    lista: function() {
      let ordem = this.ordem || "asc";
      let ordemCol = this.ordemcol || 0;
      ordem = ordem.toLowerCase();
      ordemCol = parseInt(ordemCol);
      if (ordem == "asc") {
        this.itens.sort((a, b) => {
          if (a[ordemCol] < b[ordemCol]) {
            return 1;
          }
          if (a[ordemCol] > b[ordemCol]) {
            return -1;
          }
          return 0;
        });
      }else{
         this.itens.sort((a, b) => {
          if (a[ordemCol] > b[ordemCol]) {
            return 1;
          }
          if (a[ordemCol] < b[ordemCol]) {
            return -1;
          }
          return 0;
        }); 
      }
      let busca = this.buscar;
      return this.itens.filter(res => {
        for (let k = 0; k < res.length; k++) {
          if ((res[k] + "").toLowerCase().indexOf(busca.toLowerCase()) >= 0) {
            return true;
          }
        }

        return false;
      });
      return this.itens;
    }
  }
};
</script>
