<?php



/**
 * Skeleton subclass for performing query and update operations on the 'shop_products' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Shop
 */
class SProductsQuery extends BaseSProductsQuery {

    public function combinator()
    {
        /*
            $this->join('SProductPropertiesData f1')
            ->join('SProductPropertiesData f2')
            ->join('SProductPropertiesData f3')

            ->condition('color1', 'f1.PropertyId = ?', '1')  
            ->condition('color2', 'f1.Value = ?', 'Blue')  
            ->combine(array('color1', 'color2'), 'and', 'C1')

            ->condition('color11', 'f1.PropertyId = ?', '1')
            ->condition('color22', 'f1.Value = ?', 'Silver')  
            ->combine(array('color11', 'color22'), 'and', 'C2')

            ->combine(array('C1','C2'),'or','colors')

            // Operator
            ->condition('op1', 'f3.PropertyId = ?', '2')
            ->condition('op2', 'f3.Value = ?', 'UMC')  
            ->combine(array('op1', 'op2'), 'and', 'operator1')

            // Operator2
            ->condition('op11', 'f3.PropertyId = ?', '2')
            ->condition('op22', 'f3.Value = ?', 'MTS')  
            ->combine(array('op11', 'op22'), 'and', 'operator12')

            ->combine(array('operator1','operator12'),'or','operators')

            ->where(array('colors','operators'), 'and')

            ->distinct();
        */

        $data = array(
            1=>array('Blue','Silver'),
            2=>array('MTS','UMC'),
        );

        $n=0;
        foreach ($data as $key=>$values)
        {
            $combiners=array();
            foreach ($values as $searchText)
            {
                $alias = 'C'.$n;
                $c1 = $alias.$n.'c1';
                $c2 = $alias.$n.'c2';
                $combineName = 'Combine'.$n;

                $this->join('SProductPropertiesData '. $alias);
                
                $this->condition($c1, $alias.'.PropertyId = ?', $key); 
                $this->condition($c2, $alias.'.Value = ?', $searchText);
                $this->combine(array($c1,$c2), 'and', $combineName);

                $combiners[]=$combineName;

                $n++;
            }

            $this->combine($combiners,'or','Combiner'.$n);
            $allCombiners[] = 'Combiner'.$n;  
        }
        
        $this->where($allCombiners, 'and');
        $this->distinct();

        return $this;
    }

} // SProductsQuery
