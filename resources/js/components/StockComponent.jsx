/* IMPORTACIONES DE REACT */
import React, {useMemo} from 'react'

/* COMPONENTE DE STOCK DE INGREDIENTES */
function StockComponent({ingredients, current}) {

    /* ARRAY CON LAS LLAVES DEL INGREDIENTE ACTUALMENTE SELECCIONADO PARA EL COLOREO AUTOMATICO */
    const keys = useMemo(() => (current ? current.food.ingredients.map(ingredient => ingredient.ingredient_key) : []), [current])

    return (
        <>
            {/* TITULAR DEL COMPONENTE */}
            <h3 className="text-center">Stock</h3>

            <div className="mini-table">
                {/* MINI TABLA INFORMATIVA DE INGREDIENTES QUE DETECTA Y COLOREA VERDE LOS INGREDIENTES QUE SE UTILIZARAN PARA COCINAR */
                    ingredients.map(ingredient => (
                        <div key={ingredient.ingredient_key} className={`mini-cell ${keys.includes(ingredient.ingredient_key) ? ingredient.ingredient_amount > 0 ? "ingredient-active" : "ingredient-unactive" : ""}`}>
                            <div>{ ingredient.ingredient_name }</div>
                            <div>{ ingredient.ingredient_amount }</div>
                        </div>
                    ))
                }
            </div>
        </>
    )
}

export default StockComponent