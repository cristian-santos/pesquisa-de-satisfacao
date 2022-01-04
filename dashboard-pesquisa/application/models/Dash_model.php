<?php
defined('BASEPATH') or exit('No directc script access allowed');

class Dash_model extends CI_Model
{

    public function filtro($dtinicio = null, $dtfim = null)
    {
        $sql = 'select * from data_avaliacao';
        if (!empty($dtinicio) && !empty($dtfim)) {
            $sql = 'where dtinicio::date >= ' . $dtinicio;
            $sql =  'and dtfim::date >= ' . $dtfim;
        }

        $query = $this->db->query($sql);
        return $query->result();
    }

    // implementação
    public function getByFilter($dtinicio = null, $dtfim = null)
    {

        $sql = "select sum(nivel_gentileza) as nivel_gentileza, sum(nivel_satisfacao) as nivel_satisfacao, sum(chance_indicacao) as chance_indicacao from pesquisa_satisfacao ";
        if (!empty($dtinicio) && !empty($dtfim)) {
            $sql .= " where data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getPesquisaGentileza($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        count(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_gentileza = 1 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as one_star,            
                (
                    SELECT 
                        count(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 2  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as two_star,            
                (
                    SELECT 
                        count(nivel_gentileza) as three_star
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 3  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as three_star,
                (
                    SELECT 
                        count(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 4 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as four_star,
                (
                    SELECT 
                        count(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 5 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as five_star;
        ";

        $query = $this->db->query($sql);
        return $query->result()[0];
   
    }

    public function getPesquisaSatisfacao($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        count(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 1 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as one_star_sat,            
                (
                    SELECT 
                        count(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_satisfacao = 2  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as two_star_sat,            
                (
                    SELECT 
                        count(nivel_satisfacao) as three_star
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 3  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as three_star_sat,
                (
                    SELECT 
                        count(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 4 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as four_star_sat,
                (
                    SELECT 
                        count(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 5 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as five_star_sat;
        ";

        $query = $this->db->query($sql);
        return $query->result()[0];
   
    }

    public function getChanceIndicacao($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        count(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 1 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as one_star_ind,            
                (
                    SELECT 
                        count(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 2  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as two_star_ind,            
                (
                    SELECT 
                        count(chance_indicacao) as three_star
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 3  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as three_star_ind,
                (
                    SELECT 
                        count(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 4 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as four_star_ind,
                (
                    SELECT 
                        count(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 5 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as five_star_ind;
        ";

        $query = $this->db->query($sql);
        return $query->result()[0];
   
    }

    public function totalVotantes($dtinicio, $dtfim)
    {
        $sql = "SELECT COUNT(pesquisa_satisfacao) FROM pesquisa_satisfacao";
        $sql .= " where data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date";

        $query = $this->db->query($sql);
        return $query->result();
    }

    // Porcentagem
    public function getGentilezaRating($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        sum(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_gentileza = 1 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as one_star,            
                (
                    SELECT 
                        sum(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 2  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as two_star,            
                (
                    SELECT 
                        sum(nivel_gentileza) as three_star
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 3  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as three_star,
                (
                    SELECT 
                        sum(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 4 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as four_star,
                (
                    SELECT 
                        sum(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    nivel_gentileza = 5 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as five_star;
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getSatisfacaoRating($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        sum(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 1 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as one_star,            
                (
                    SELECT 
                        sum(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 2  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as two_star,            
                (
                    SELECT 
                        sum(nivel_satisfacao) as three_star
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 3  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as three_star,
                (
                    SELECT 
                        sum(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 4 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as four_star,
                (
                    SELECT 
                        sum(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        nivel_satisfacao = 5 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as five_star;
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getIndicacaoRating($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        sum(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                    chance_indicacao = 1 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as one_star,            
                (
                    SELECT 
                        sum(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 2  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as two_star,            
                (
                    SELECT 
                        sum(chance_indicacao) as three_star
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 3  and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as three_star,
                (
                    SELECT 
                        sum(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 4 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as four_star,
                (
                    SELECT 
                        sum(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    WHERE
                        chance_indicacao = 5 and data_avaliacao::date between '$dtinicio'::date and '$dtfim'::date
                ) as five_star;
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function totalVotos($dtinicio, $dtfim)
    {
        $sql = "
            SELECT
                (
                    SELECT 
                        sum(nivel_gentileza)
                    from 
                        pesquisa_satisfacao
                )as gentileza,        
                (
                    SELECT 
                        sum(nivel_satisfacao)
                    from 
                        pesquisa_satisfacao
                ) as satisfacao,      
                (
                    SELECT 
                        sum(chance_indicacao)
                    from 
                        pesquisa_satisfacao
                    )as indicacao";

        $query = $this->db->query($sql);
        return $query->result();
    
    }

     public function salvarUsuario($user)
     {
       $this->db->insert('usuario', $user);
     }

     public function listar_usuarios()
     {
        $sql = "select * from usuario order by login ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function excluir($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('usuario');
    }
}