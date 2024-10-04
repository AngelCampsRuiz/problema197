Algoritmo Problema197
	Escribir 'Introduce la frase que quieres desencriptar'
	Leer MensajeEncriptado
	Escribir 'Que proceso quieres seguir (X2 o X1)'
	Leer Proceso1
	Si Proceso1=X2 Entonces
		Escribir 'Que proceso quieres elegir: X2 a X o X2 a X1?'
		Leer Proceso2
		Si Proceso2=X2aX Entonces
			// X2 a X
			Leer X2
			array(X1) = lenght(n) 
			par = 0, impar = X2 -1
			Si indice = par Entonces
				"Vocal al inicio de la frase"
			SiNo
				"Vocal al final de la frase"
			FinSi
			Convertir array(X1) en cadena
			InvertirNoVocales con X1 para pasar de X1 a X
			Escribir resultado
		SiNo
			// X2 a X1
			Leer X2
			Array(X1) = ""
			izquierda = 0, derecha = n - 1
			Si indice = par Entonces
				"Vocal al inicio de la frase"
			SiNo
				"Vocal al final de la frase"
				derecha-1
			FinSi
			Convertir X1 en cadena
			Escribir Resultado
		FinSi
	SiNo
		// X1 a X‰
		Leer X1
		resultado = '', i = 0, n = lenght(X1)
		Mientras i<n Hacer
			j <- i
			Mientras j < n, caracter en j <> vocal Hacer
				j++
			FinMientras
			i = j
		FinMientras
		Escribir resultado
	FinSi
	Escribir resultado
FinAlgoritmo
