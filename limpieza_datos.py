# Imports
import pandas as pd
import os

import manejo_de_errores as err
# -------------------------------------------------------------------------------------------------

# Funciones:
def leer_archivo(path: list, sheet_name:str, column_names:list): 
    excel_file_path = os.path.join(*path)
    df = pd.read_excel(excel_file_path, sheet_name=sheet_name, usecols=column_names)
    return df


# -------------------------------------------------------------------------------------------------
def manejo_errores(df, largo_maximo, columna, tipo_error):
    user_choices = {}
    if columna in user_choices:
        user_input = user_choices[columna]
    else:
        print(f"Options for column '{columna}':")
        print("[1] Fill NaN's")
        print("[2] Skip")
        print("[3] Halt")
        user_input = input(f"Ingrese una opción listada para solucionar el error en '{columna}': ")
        user_choices[columna] = user_input

    if user_input == '1':
        if tipo_error == 'str_length':
            df.loc[df.index, columna] = df.loc[df.index, columna].where(df.loc[df.index, columna].apply(len) <= largo_maximo, pd.NA)
        else:
            df[columna] = pd.to_numeric(df[columna], errors='coerce')

    elif user_input == '2':
        pass

    elif user_input == '3':
        print("Halting data conversion.")
        return True
    else:
        print("Invalid input. Skipping the error.")
    return False


# -------------------------------------------------------------------------------------------------
def convert_columns_to_dtype(df, conversions):
    for columna, tipo_dato, largo_maximo in conversions:

        if tipo_dato == 'VARCHAR' and largo_maximo is not None:
            try:
                df[columna] = df[columna].astype(str).apply(lambda x: err.revisar_largo_str(x, largo_maximo))
            except err.StringLengthExceededError as e:
                print(f"Error converting column '{columna}' to type '{tipo_dato}': {str(e)}")
                halt_conversion = manejo_errores(df, largo_maximo, columna, 'str_length')
                if halt_conversion:
                    return
                
        elif tipo_dato == 'DATE':
            try:
                
                df[columna] = pd.to_datetime(df[columna], errors='coerce')
                df[columna] = df[columna].dt.strftime('%Y-%m-%d')
            except (ValueError, TypeError) as e:
                print(f"Error converting column '{columna}' to type '{tipo_dato}': {str(e)}")
                halt_conversion = manejo_errores(df, largo_maximo, columna, 'date')
                if halt_conversion:
                    return
                
        elif tipo_dato == 'INT':
            try:
                df[columna] = pd.to_numeric(df[columna], errors='raise').astype('Int64')
            except ValueError:
                print(f"Conversion error in '{columna}' column. Handling non-convertible values separately.")
                choice = input("Enter 'Y' to fill NaN's or any other key to skip: ").lower()
                if choice == 'y':
                    df[columna] = pd.to_numeric(df[columna], errors='coerce').astype('Int64')
                else:
                    df[columna] = pd.to_numeric(df[columna], errors='coerce')
        
        elif tipo_dato == 'FLOAT':
            try:
                df[columna] = pd.to_numeric(df[columna], errors='raise')
            except (ValueError, TypeError) as e:
                print(f"Error converting column '{columna}' to type '{tipo_dato}': {str(e)}")
                halt_conversion = manejo_errores(df, largo_maximo, columna, 'FLOAT')

                if halt_conversion:
                    return
                
                else:
                    df[columna] = pd.to_numeric(df[columna], errors='raise', downcast='integer')


# -------------------------------------------------------------------------------------------------

# Código
if __name__ == '__main__':

    conversions = [
        ('usernames', 'VARCHAR', 10),  
        ('ages', 'INT', None),  
        ('scores', 'FLOAT', None),  
        ('birthday', 'DATE', None)
    ]

    data = {
        'usernames': ['Alice', 'Bob', 'Charlie', 123456, 'Eve', 'Frank', 'Grace', 98765, '42069', 'Ivy',
                    'John', 'Kelly', 'Liam', 'Mary', 'Nancy', 'Oliver', 'Peter', 'Quinn', 'Rachel', 'Sophie'],
        'ages': [25, 30, 35, 40, 45, 12, 55, 60, 65, 70.4, 75, 80, 85, 90, 95, 100, 105, 110, 115, 120],
        'scores': [90.5, 85.3, 78.9, 'invalid', 93.2, 87, 82.1, 'NaN', 95.4, 89.7, 76.3, 81.2, 100.0, 85.0, 'invalid', 91.7, 88.4, 79.1, 83.8, 97.6],
        'birthday': ['05-20-1990', '10-15-1985', '12-31-20002', '2005-07-12', '03-25-1975', '06-18-1970', '09-05-1965', '1970-08-02', '02-14-1955', '05-30-1950',
                    '11-12-1945', '08-04-1940', '01-01-1935', '04-10-1930', '07-22-1925', '02-17-1920', '05-05-1915', '09-29-1910', '12-03-1905', '03-08-1900']
    }

    df = pd.DataFrame(data)
    convert_columns_to_dtype(df, conversions)
    print(df)