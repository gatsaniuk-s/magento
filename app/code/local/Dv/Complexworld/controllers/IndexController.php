<?php

class Dv_Complexworld_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {

      /*  array("eq"=>'n2610')
        WHERE (e.sku = 'n2610')

        array("neq"=>'n2610')
        WHERE (e.sku != 'n2610')

        array("like"=>'n2610')
        WHERE (e.sku like 'n2610')

        array("nlike"=>'n2610')
        WHERE (e.sku not like 'n2610')

        array("is"=>'n2610')
        WHERE (e.sku is 'n2610')

        array("in"=>array('n2610'))
        WHERE (e.sku in ('n2610'))

        array("nin"=>array('n2610'))
        WHERE (e.sku not in ('n2610'))

        array("notnull"=>true)
        WHERE (e.sku is NOT NULL)

        array("null"=>true)
        WHERE (e.sku is NULL)

        array("gt"=>'n2610')
        WHERE (e.sku > 'n2610')

        array("lt"=>'n2610')
        WHERE (e.sku < 'n2610')

        array("gteq"=>'n2610')
        WHERE (e.sku >= 'n2610')

        array("moreq"=>'n2610') //a weird, second way to do greater than equal
        WHERE (e.sku >= 'n2610')

        array("lteq"=>'n2610')
        WHERE (e.sku <= 'n2610')

        array("finset"=>array('n2610'))
        WHERE (find_in_set('n2610',e.sku))

        array('from'=>'10','to'=>'20')
        WHERE e.sku >= '10' and e.sku <= '20' */

        $filter_a = array('like'=>'a%');
        $filter_b = array('like'=>'b%');

        var_dump(
        Mage::getModel('complexworld/eavblogpost')
            ->getCollection()
            ->addFieldToFilter('title', array($filter_a, $filter_b))
            ->getSelect()
        );


    }

    public function populateEntriesAction() {
        for ($i=0;$i<10;$i++) {
            $weblog2 = Mage::getModel('complexworld/eavblogpost');
            $weblog2->setTitle('This is a test '.$i);
            $weblog2->setContent('This is test content '.$i);
            $weblog2->setDate(now());
            $weblog2->save();
        }

        echo 'Done';
    }

    public function showCollectionAction() {
        $weblog2 = Mage::getModel('complexworld/eavblogpost');
        $entries = $weblog2->getCollection()
            ->addAttributeToSelect('title')
            ->addAttributeToSelect('content');
        $entries->load();
        foreach($entries as $entry)
        {
            // var_dump($entry->getData());
            echo '<h2>' . $entry->getTitle() . '</h2>';
            echo '<p>Date: ' . $entry->getDate() . '</p>';
            echo '<p>' . $entry->getContent() . '</p>';
        }
        echo '</br>Done</br>';
    }
}
