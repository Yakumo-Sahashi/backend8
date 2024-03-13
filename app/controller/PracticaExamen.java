import java.util.Arrays;
//import java.util.Scanner;
import javax.swing.JOptionPane;

public class PracticaExamen{
    
    //static Scanner sc = new Scanner(System.in);
    static int numeros[] = new int[5];
    static int x = 0;
    
    public static void main(String []args){
        do{
            validarCaracter();
        }while(x < 5);
        System.out.println("Numeros desordenados: " + Arrays.toString(numeros));
        ordenar();
        imprimir();
    }
        public static int capNum(){
            int temp = 0;
            //System.out.println("Ingresa un numero entre 1 - 20:");
            //temp = sc.nextInt();
            temp = Integer.parseInt(JOptionPane.showInputDialog("Ingrese un numero entre 1 - 20:"));
            return temp;
        }
        public static int validarRango(int validarNum){
            int correcto = 0;
            if (validarNum >= 1 && validarNum <= 20) {
                correcto = validarNum;
                System.out.println("El numero: " + correcto + " es valido.");
            }else{
                JOptionPane.showMessageDialog(null, "Numero fuera de rango.");
            }
            return correcto;
        }
        public static void validarCaracter(){
            try{
                int numero = capNum();
                numero = validarRango(numero);
                numeros[x] = numero;
                x++;
            }catch(Exception e){
            JOptionPane.showMessageDialog(null, "El dato ingresado es erroneo.");
                //sc.nextLine();
                validarCaracter();            
            }
        }
        public static void ordenar(){
            int aux = 0;
            for(int i = 0; i < numeros.length; i++){
                for(int j = 0; j < numeros.length-1; j++){
                    if(numeros[j + 1] < numeros[j]){
                        aux = numeros[j + 1];
                        numeros[j + 1] = numeros[j];
                        numeros[j] = aux;
                    }
                }
            }
        }
        public static void imprimir(){
            System.out.println("Numeros ordenados de menor a mayor: " + Arrays.toString(numeros));
        }
}