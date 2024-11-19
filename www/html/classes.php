<?php

class Torta {
    protected $id;
    protected $nome;
    protected $preco;
    protected $quantidade;

    public function __construct($id, $nome, $preco, $quantidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    // Método para calcular o subtotal de um produto (preço * quantidade)
    public function calcularSubtotal() {
        return $this->preco * $this->quantidade;
    }
}

class TortaPremium extends Torta {
    public function __construct($id, $nome, $preco, $quantidade) {
        // Sobrescreve o preço adicionando um valor extra para tortas premium
        parent::__construct($id, $nome, $preco + 5.00, $quantidade);
    }
}
?>
