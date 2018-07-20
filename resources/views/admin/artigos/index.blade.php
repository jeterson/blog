@extends('layouts.app')

@section('content')
<pagina tamanho="12">
    <painel titulo="Lista de Artigos">
        <tabela-lista         
        v-bind:titulos="['#', 'Titulo', 'Descrição']"
        v-bind:itens="[['1', 'Php orientado a objeto', 'Curso de PHP OO'],['2', 'Vue Js', 'Curso de Vue Js']]" 
        criar="#criar" editar="#editar"  deletar="#fdd" detalhe="#detalhe" order="desc" ordercol="1"
        >
        
        </tabela-lista>
    </painel>
</pagina>
@endsection
