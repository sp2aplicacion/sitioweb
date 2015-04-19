function verFilas(fila,visible) 
	{
	var elementos = document.getElementsByName(fila);
	for (k=0; k < elementos.length; k++)
		{
		if(visible==0)
	  		elementos[k].style.display = "none";
		else
			elementos[k].style.display = "";
		}
	}

function obtenerCalificacion(indicador)
	{
	for(i=0; i<6; i++)
		{
	    if (indicador[i].checked)
			{
        	if(indicador[i].value==-1)
               return 0;
            else 
               return indicador[i].value;
			} 			 	
		}
}

function calcularCalificacion() 
	{
	if(document.forms.Formulario.asistencia[0].checked) 				//Hay Asistencia
		{
		var sumatoriaIndicadores=0;//Calcula la sumatoria de la calificacion de todos los indicadores
		var numIndicadores=0;// Calcula la cantidad de indicadores evaluados
		var facultad=document.forms.Formulario.facultad.value;
		if(!document.forms.Formulario.calificacionCumplimientoCompromisos.selectedIndex==0)// si el valor es diferente a NA
	   	{
		  numIndicadores++;
		  sumatoriaIndicadores+=document.forms.Formulario.calificacionCumplimientoCompromisos[document.forms.Formulario.calificacionCumplimientoCompromisos.selectedIndex].value*1;
		}
		
		if(facultad==1)
		{
   		   //alert("sumatoriaIndicadores Psicología: "+sumatoriaIndicadores);

		   //00
		   if(!document.forms.Formulario.calificacionIndicador00.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador00[document.forms.Formulario.calificacionIndicador00.selectedIndex].value*1;
		    }
		   //01
		   if(!document.forms.Formulario.calificacionIndicador01.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador01[document.forms.Formulario.calificacionIndicador01.selectedIndex].value*1;
		    }
		   //02
		   if(!document.forms.Formulario.calificacionIndicador02.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador02[document.forms.Formulario.calificacionIndicador02.selectedIndex].value*1;
		    }
		   //03
		   if(!document.forms.Formulario.calificacionIndicador03.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador03[document.forms.Formulario.calificacionIndicador03.selectedIndex].value*1;
		    }
		   //04
		   if(!document.forms.Formulario.calificacionIndicador04.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador04[document.forms.Formulario.calificacionIndicador04.selectedIndex].value*1;
			}
			//05
			if(!document.forms.Formulario.calificacionIndicador05.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador05[document.forms.Formulario.calificacionIndicador05.selectedIndex].value*1;
			}
			//10
			if(!document.forms.Formulario.calificacionIndicador10.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador10[document.forms.Formulario.calificacionIndicador10.selectedIndex].value*1;
			}
			//11
			if(!document.forms.Formulario.calificacionIndicador11.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador11[document.forms.Formulario.calificacionIndicador11.selectedIndex].value*1;
			}
			//12
			if(!document.forms.Formulario.calificacionIndicador12.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador12[document.forms.Formulario.calificacionIndicador12.selectedIndex].value*1;
			}
			//13
			if(!document.forms.Formulario.calificacionIndicador13.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador13[document.forms.Formulario.calificacionIndicador13.selectedIndex].value*1;
			}

			//14
			if(!document.forms.Formulario.calificacionIndicador14.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador14[document.forms.Formulario.calificacionIndicador14.selectedIndex].value*1;
			}
			
			//15
			if(!document.forms.Formulario.calificacionIndicador15.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador15[document.forms.Formulario.calificacionIndicador15.selectedIndex].value*1;
			}
			//16
			if(!document.forms.Formulario.calificacionIndicador16.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador16[document.forms.Formulario.calificacionIndicador16.selectedIndex].value*1;
			}
			//20
			if(!document.forms.Formulario.calificacionIndicador20.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador20[document.forms.Formulario.calificacionIndicador20.selectedIndex].value*1;
			}

			//21
			if(!document.forms.Formulario.calificacionIndicador21.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador21[document.forms.Formulario.calificacionIndicador21.selectedIndex].value*1;
			}

			//22
			if(!document.forms.Formulario.calificacionIndicador22.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador22[document.forms.Formulario.calificacionIndicador22.selectedIndex].value*1;
			}

			//23
			if(!document.forms.Formulario.calificacionIndicador23.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador23[document.forms.Formulario.calificacionIndicador23.selectedIndex].value*1;
			}

			//24
			if(!document.forms.Formulario.calificacionIndicador24.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador24[document.forms.Formulario.calificacionIndicador24.selectedIndex].value*1;
			}	
			
			alert("Hola");
			//30
			if(!document.forms.Formulario.calificacionIndicador30.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador30[document.forms.Formulario.calificacionIndicador30.selectedIndex].value*1;
			}
			//31
			if(!document.forms.Formulario.calificacionIndicador31.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador31[document.forms.Formulario.calificacionIndicador31.selectedIndex].value*1;
			}
			//32
			if(!document.forms.Formulario.calificacionIndicador32.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador32[document.forms.Formulario.calificacionIndicador32.selectedIndex].value*1;
			}
		}
		
		if(facultad==5 || facultad==3 || facultad==7)
		{
		    //alert("sumatoriaIndicadores Matematicas: "+sumatoriaIndicadores);

		   //00
		   if(!document.forms.Formulario.calificacionIndicador00.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador00[document.forms.Formulario.calificacionIndicador00.selectedIndex].value*1;
		    }
		   //01
		   if(!document.forms.Formulario.calificacionIndicador01.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador01[document.forms.Formulario.calificacionIndicador01.selectedIndex].value*1;
		    }
		   //02
		   if(!document.forms.Formulario.calificacionIndicador02.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador02[document.forms.Formulario.calificacionIndicador02.selectedIndex].value*1;
		    }
		   //03
		   if(!document.forms.Formulario.calificacionIndicador03.selectedIndex==0)// si el valor es diferente a NA
		    {
		      numIndicadores++;
		      sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador03[document.forms.Formulario.calificacionIndicador03.selectedIndex].value*1;
		    }
		   //04
		   if(!document.forms.Formulario.calificacionIndicador04.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador04[document.forms.Formulario.calificacionIndicador04.selectedIndex].value*1;
			}
			//05
			if(!document.forms.Formulario.calificacionIndicador05.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador05[document.forms.Formulario.calificacionIndicador05.selectedIndex].value*1;
			}
			//10
			if(!document.forms.Formulario.calificacionIndicador10.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador10[document.forms.Formulario.calificacionIndicador10.selectedIndex].value*1;
			}
			//11
			if(!document.forms.Formulario.calificacionIndicador11.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador11[document.forms.Formulario.calificacionIndicador11.selectedIndex].value*1;
			}
			//12
			if(!document.forms.Formulario.calificacionIndicador12.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador12[document.forms.Formulario.calificacionIndicador12.selectedIndex].value*1;
			}
			//13
			if(!document.forms.Formulario.calificacionIndicador13.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador13[document.forms.Formulario.calificacionIndicador13.selectedIndex].value*1;
			}

			//14
			if(!document.forms.Formulario.calificacionIndicador14.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador14[document.forms.Formulario.calificacionIndicador14.selectedIndex].value*1;
			}
			
			//15
			if(!document.forms.Formulario.calificacionIndicador15.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador15[document.forms.Formulario.calificacionIndicador15.selectedIndex].value*1;
			}
			//16
			if(!document.forms.Formulario.calificacionIndicador16.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador16[document.forms.Formulario.calificacionIndicador16.selectedIndex].value*1;
			}
			//20
			if(!document.forms.Formulario.calificacionIndicador20.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador20[document.forms.Formulario.calificacionIndicador20.selectedIndex].value*1;
			}

			//21
			if(!document.forms.Formulario.calificacionIndicador21.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador21[document.forms.Formulario.calificacionIndicador21.selectedIndex].value*1;
			}

			//22
			if(!document.forms.Formulario.calificacionIndicador22.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador22[document.forms.Formulario.calificacionIndicador22.selectedIndex].value*1;
			}

			//23
			if(!document.forms.Formulario.calificacionIndicador23.selectedIndex==0)// si el valor es diferente a NA
			{
			   numIndicadores++;
			   sumatoriaIndicadores+=document.forms.Formulario.calificacionIndicador23[document.forms.Formulario.calificacionIndicador23.selectedIndex].value*1;
			}
		
		}		

        var calificacionIndicadores; // Calcula la nota tentativa
		
		if(numIndicadores==0)
			calificacionIndicadores=-1;
		else
			calificacionIndicadores=sumatoriaIndicadores/numIndicadores;	// Calcula la nota promedio
			
		//  alert('suma de valor de indicadores='+sumatoriaIndicadores);
		//  alert('cantidad indicadores='+numIndicadores);	
        //  alert('calificacion tentativa='+calificacionIndicadores); 		
		
		  document.forms.Formulario.calificacionSesion.value=Math.round(calificacionIndicadores);
		}
	else
		{
		   document.forms.Formulario.calificacionSesion.value=0;
		}
	if(document.forms.Formulario.calificacionSesion.value==0)
		{
			 document.forms.Formulario.calificacionSesion.value="";				
		}
	}
