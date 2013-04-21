
<input type="submit" class="btn" value="Уведомить о снижении цены" onclick="spy({echo $Id},{echo $varId}, this);
        return false"/>
<br>
<input type="submit" class="btn" value="Отписаться " onclick="unspy({$product[hash]});
        return false"/>
