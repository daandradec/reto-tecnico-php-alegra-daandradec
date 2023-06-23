/* IMPORTACIONES DE REACT */
import React from 'react'

/* COMPONENTE DEL MENU DE COMIDAS */
function MenuComponent({foods}) {
  return (
    <>
        {/* TITULAR DEL COMPONENTE */}
        <h3 className="text-center">Menu</h3>

        <div className="mini-table">
            {/* MINI TABLA INFORMATIVA DE COMIDAS DEL MENU */
                foods.map(food => (
                    <div key={food.id} className="mini-cell">
                        <div>{ food.food_name }</div>
                        <img src={food.food_path_img} alt={food.food_key} style={{width:"66px",height:"auto"}}/>
                    </div>   
                ))
            }
        </div>    
    </>
  )
}

export default MenuComponent