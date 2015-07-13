<?php

class View
{

    public function display( $tpl, $print = 1 )
    {
        //zwraca wszystkie dynamiczne wartości przypisane do views
        $data = get_object_vars( $this );

        if( count( $data ) )
        {
            foreach( $data as $key => $val )
            {
                ${$key} = $val;
            }
        }

        $partial = $this;

        if( $print )
        {
            include_once( 'tpl_' . $tpl . '.php' );
        }
        else
        {
            ob_start();
            include_once( 'tpl_' . $tpl . '.php' );
            $content = ob_get_contents();
            ob_end_clean();

            return $content;
        }
    }
}
