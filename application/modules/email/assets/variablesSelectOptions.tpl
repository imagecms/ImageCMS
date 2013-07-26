{foreach $variables as $variable => $variableValue} 
    <option title="{echo $variableValue}" value="{echo $variable}">{echo $variableValue}</option>
{/foreach}