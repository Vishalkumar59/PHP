import java.util.Scanner;
class mp
{
	public static void main(String arg[])throws Exception
	{
	float num1,num2;
	int t, q=1;
	
	Scanner sc=new Scanner(System.in);
	
	int sw;
	do{
	System.out.println("what do you want to do:");
	System.out.println("press 1 for +\npress 2 for -\npress 3 for *\npress 4 for /\npress 5 for remender\npress 6 for square\npress 7 for cube\npress 8 for %\npress 9 for check odd or even\npress 10 for find large number\npress 11 for find small number\npress 12 for printing table\npress 13 for find profit or loss\npress 14 for find the sum of n numbers");
	sw=sc.nextInt();
	
	switch(sw){
	case 1 : 
		System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		float sum=num1+num2;
	System.out.println("sum="+sum);
	
	
	break;
	case 2 :  System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		 float sub=num1-num2;
	System.out.println("sub="+sub);
	break;
	case 3 : System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		float multi=num1*num2;
	System.out.println("multi="+multi);
	break;
	case 4 : System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		 float div=num1/num2;
	System.out.println("div="+div);
	break;
	case 5 :  System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		float mod=num1%num2;
	System.out.println("mod="+mod);
	break;
	case 6 : System.out.println("ENTER ANY  NUMBERS:");
	int sq=sc.nextInt();
		int square=sq*sq;
		System.out.println("square="+square);
	break;
	case 7 : System.out.println("ENTER ANY  NUMBERS:");
	int cu=sc.nextInt();
		int cube=cu*cu*cu;
		System.out.println("cube="+cube);
	break;
	case 8 :System.out.println("ENTER ANY NUMBERS:");
	num1=sc.nextFloat();
	System.out.println("how many % you want");
	num2=sc.nextFloat();
		float percentage=(num1*num2)/100;
		System.out.println("percentage="+percentage);
	break;
	case 9 :System.out.println("ENTER ANY  NUMBERS:");
	int oe=sc.nextInt();
	if(oe%2==0)
		System.out.println("your number "+oe+" is even");
	else
		System.out.println("your number "+oe+" is odd");
	break;
	case 10 :System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		if(num1>num2)
			System.out.println("largest number="+num1);
		else if(num2>num1)
			System.out.println("largest number="+num2);
		else 
			System.out.println("both numbers are equal");
	
	break;
	case 11 :System.out.println("ENTER ANY TWO NUMBERS:");
	num1=sc.nextFloat();
	num2=sc.nextFloat();
		if(num1<num2)
			System.out.println("small number="+num1);
		else if(num2<num1)
			System.out.println("small number="+num2);
		else 
			System.out.println("both numbers are equal");
		
	break;
	case 12 : System.out.println("ENTER ANY  NUMBERS:");
	int tb=sc.nextInt();
	int tab;
		for(int i=0; i<=10; i++){
		 tab=i*tb;	
		if(i<=0){
			System.out.println("table of "+tb+" is:");
			}
		else
		System.out.println(tab);
		}
	break;
 	case 13 : System.out.println("ENTER BUY PRICE:");
		float by=sc.nextFloat();
		System.out.println("ENTER SELL PRICE:");
		float se=sc.nextFloat();
		if(se>=by){
			float profit=se-by;
			System.out.println("profit="+profit);}
		else if(se<=by){
		float loss=by-se;
			System.out.println("loss="+loss);
		}
	case 14 : float arr[]=new float[50];
		int n;
		System.out.println("how many numbers of sum you want:");
		n=sc.nextInt();
		float sm=0;
		System.out.println("ENTER ANY "+n+" NUMBERS:");
		for(int i=0; i<=n-1; i++){
			arr[i]=sc.nextFloat();
			sm=sm+arr[i];
			}
		System.out.println("total sum of your numbers="+sm);		
	break;
	}System.out.println("do you want to do something else\nif yes press 1 else press any key");
		t=sc.nextInt();
	}while(t==q);
		

	System.out.println("THANK YOU!");

	System.out.println("----------------------------------------------------------------------------------------------------------------------");
	System.out.println("THIS IS CREATED BY");

	int i,j,k;
	
		// print V
		for(j=1; j<=9; j++)
		{
			if(j==1 || j==9)
			System.out.print("*");
			else
			System.out.print(" ");
		}
		System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==2 || j==8)
			System.out.print("*");
			else
			System.out.print(" ");
		}
		System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==3 || j==7)
			System.out.print("*");
			else
			System.out.print(" ");
		}
		System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==4 || j==6)
			System.out.print("*");
			else
			System.out.print(" ");
		}
		System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==5)
			System.out.print("*");
			else
			System.out.print(" ");
		}Thread.sleep(2000);
		System.out.println();
		System.out.println();
			

		// print I
		for(i=1; i<=5; i++)
		{
			for(j=1; j<=5; j++)
			{
				if(j==5)	
				System.out.print("*");
				else
				System.out.print(" ");
				
			}
			System.out.println();
		}Thread.sleep(2000);
		System.out.println();
		
		
		// print S
		for(j=1; j<=9; j++)
		{
				if(j==1 || j==9)
				System.out.print(" ");
				else 
				System.out.print("*");
		}System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==1 || j==9)
			System.out.print("*");
			else
			System.out.print(" ");	
		}System.out.println();
		System.out.print("*");
		System.out.println();
		for(j=1; j<=9; j++)
		{
				if(j==1 || j==9)
				System.out.print(" ");
				else
				System.out.print("*");
		}System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==9)
			System.out.print("*");
			else
			System.out.print(" ");	
		}System.out.println();
		for(j=1; j<=9; j++)
		{
			if(j==1 || j==9)
			System.out.print("*");
			else
			System.out.print(" ");	
		}System.out.println();
		for(j=1; j<=9; j++)
		{
		if(j==1 || j==9)
				System.out.print(" ");
				else
				System.out.print("*");
		}Thread.sleep(2000);

		System.out.println();
		System.out.println();
		
		// print H
		for(i=1; i<=5; i++)	
		{
			if(i==1 || i==2){
			for(j=1; j<=9; j++)
			{
				if(j==1 || j==9)
				System.out.print("*");
				else
				System.out.print(" ");
			}
			System.out.println();}
			else if(i==3){
			for(j=1; j<=9; j++)
			{
				if(j%2==1)
				System.out.print("*");
				else
				System.out.print(" ");
			}System.out.println();}
	
			else if(i==4 || i==5){
			for(j=1; j<=9; j++)
			{
				if(j==1 || j==9)
				System.out.print("*");
				else
				System.out.print(" ");
			}System.out.println();
			}
			
		}Thread.sleep(2000);

		System.out.println();
		
		
		// print A
		for(j=1; j<=9; j++)
		{
			if(j==5)
			System.out.print("*");
			else 
			System.out.print(" ");
		}System.out.println();
		for(j=1; j<=9; j++){	
			 if(j==4 || j==6)
			System.out.print("*");
			else 
			System.out.print(" ");
		}System.out.println();
		for(j=1; j<=9; j++){	
			 if(j==3 || j==5 || j==7)
			System.out.print("*");
			else 
			System.out.print(" ");
		}System.out.println();
		for(j=1; j<=9; j++){	
			 if(j==2 || j==8)
			System.out.print("*");
			else 
			System.out.print(" ");
		}System.out.println();
		for(j=1; j<=9; j++){	
			 if(j==1 || j==9)
			System.out.print("*");
			else 
			System.out.print(" ");
		}Thread.sleep(2000);

		System.out.println();
		System.out.println();
		
		//print L
		for(i=1; i<=5; i++)
		{
			if(i!=5){
			
			System.out.print("*");
			System.out.println();}
			else{
			for(j=1; j<=9; j++)
			{	if(j%2==1)
			System.out.print("*");
			else
			System.out.print(" ");
			}}
		}Thread.sleep(2000);

		
		

	}}