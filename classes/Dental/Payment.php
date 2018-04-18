<?php 

/**
 * summary
 */
class Payment
{
    public function __get($name) 
    {
        if ($name == 'db') {
            return MySQL::getInstance();
        }
        elseif ($name == 'tratamiento') {
            return new Treatment($this->id_tratamiento);
        }
        elseif ($name == 'fecha') {
            return $this->fecha_hora;
        }
        elseif (isset($this->{$name})) {
            return $this->{$name};
        }

        return null;
    }

    public function __construct($id) 
    {
        if (!$id) {
            return false;
        }

        if (is_numeric($id)) {
            $this->id = $id;
        }
        elseif (is_array($id)) {
            // CAMPOS NECESARIOS
            if (!isset($id['id_tratamiento'], $id['monto']) || !is_numeric($id['id_tratamiento']) || !is_numeric($id['monto'])) {
                return false;
            }

            $this->tratamiento = new Treatment($id['id_tratamiento']);

            foreach ($id as $k => $v) {
                if (preg_match('/^id_tratamiento|monto|anotaciones|motivo$/', $k)) {
                    $keys[]   = $k;
                    $values[] = $this->db->escape($v);
                }
            }

            $keys[] = 'fecha_hora';

            if (!isset($id['fecha_hora']) || !$id['fecha_hora']) {
                $values[] = date('Y-m-d H:i:s');
            }
            else {
                $values[] = date('Y-m-d H:i:s', strtotime($id['fecha_hora']));
            }

            $keys[]    = 'acumulado';
            $acumulado = $this->tratamiento->acumulado() + ($id['monto'] + 0);
            $values[]  = $acumulado;

            $keys[]   = 'balance';
            $values[] = ($this->tratamiento->presupuesto + 0) - $acumulado;

            $q = "INSERT INTO pagos (" . implode(",", $keys) . ") VALUES ('" . implode("','", $values) . "')";

            $this->db->query($q);

            $this->id = $this->db->lastID();
        }

        return $this->select();
    }

    /**
     * concatena los datos para obtener la url necesaria
     * @param string $action 'editar' | 'ver' devuelven la url para segun sea ver o editar los detalles del pago, sino retorna url
     * @return sting url para ver la radiografia
     * */
    public function url($action = 'ver') 
    {
        if (preg_match('/^ver|editar$/', $action)) {
            return URL_ROOT . '/economia/' . $action . '/' . $this->url;
        }

        return $this->url;
    }

    public function select($data = '*') 
    {
        if (!$this->id || !is_numeric($this->id)) {
            return false;
        }

        $keys = ' * ';

        if ($data != '*') {
            if (!is_array($data)) {
                $data = array($data);
            }

            foreach ($data as $k) {
                if (is_string($k)) {
                    if (preg_match('/^monto|anotaciones|motivo|acumulado|balance$/', $k)) {
                        $keys[] = $k;
                    }
                    elseif (preg_match('/^(:?id_)tratamiento$/', $k)) {
                        $keys[] = 'id_tratamiento AS tratamiento';
                    }
                }
            }

            $keys = implode(', ', $keys);
        }

        $q = "SELECT {$keys} FROM pagos WHERE id_pago = {$this->id}";

        $_ = $this->db->oneRowQuery($q);

        if ($_) {
            foreach ($_ as $k => $v) {
                if ($k == 'fecha_hora') {
                    $this->{$k} = date('d/m/y', strtotime($v));
                }
                elseif (preg_match('/^monto|anotaciones|motivo|acumulado|balance$/', $k)) {
                    $this->{$k} = $v;
                }
                elseif (preg_match('/^(:?id_)tratamiento$/', $k)) {
                    $this->tratamiento = new Treatment($v);
                }
            }

            $this->url = crypt_params(array(PAGO => $this->id, TRATAMIENTO => $this->tratamiento->id, PACIENTE => $this->tratamiento->paciente->id));

            return $this;
        }

        unset($this->id);
    }

    public function delete() 
    {
        $q = "DELETE FROM pagos WHERE id_pago = '{$this->id}';";

        return $this->db->query($q);
    }

    public function update() 
    {
        $q = "UPDATE pagos SET acumulado ='{$this->acumulado}', balance ='{$this->balance}' WHERE id_pago = '{$this->id}';";

        $this->db->query($q);

        return $this;
    }
}

