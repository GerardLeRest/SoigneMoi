import tkinter as tk
from tkinter import ttk

import requests

class Details(tk.Toplevel):
    
    def __init__(self, fenetre, id):
        tk.Toplevel.__init__(self, fenetre) # Initialisation de la fenêtre Toplevel avec 'fenetre' comme parent.
        self.title(f"Patient N° {id}")
        #self.url = 'http://127.0.0.1:5000/students' - table students - university
        self.resizable(width=False, height=False) # bloquer le redimensionnement
        self.id = id
        self.listes_donnees = []
        # Cadre de l'application
        frame = ttk.Frame(self)
        frame.pack()
        
        # Créer une zone de texte
        self.zone_de_texte = tk.Text(frame, height=30, width=100)  # Assurez-vous que le widget est placé dans le Toplevel, pas dans 'fenetre'
        self.zone_de_texte.grid(row=0, column=0, sticky='nsew', padx=10, pady=10)
        # Créer une scrollbar et l'attacher à la zone de texte
        scrollbar = ttk.Scrollbar(frame, orient='vertical', command=self.zone_de_texte.yview)  # 'self' au lieu de 'fenetre'
        scrollbar.grid(row=0, column=1, sticky='ns')  # Utilisation de 'grid' au lieu de 'pack'
        # Configurer la zone de texte pour qu'elle utilise la scrollbar
        self.zone_de_texte.config(yscrollcommand=scrollbar.set)
        # récupération des donnees
        self.recuperation_donnees(self.id)
        
        # récupérer les données
    
    def recuperation_donnees(self, id):

        url_complete = f"http://localhost/slim-secretariat-web/details/{id}"
        response = requests.get(url_complete)
        if response.status_code == 200:
            # Transformer le format json en listes
            self.liste_donnees = response.json()
            #print(self.liste_donnees)
        else:
            print(f"Erreur lors de la récupération des données: {response.status_code}")
        self.affichage_donnees()
     
    def affichage_donnees(self):
        self.zone_de_texte.tag_configure("gras", font=("Helvetica", 12, "bold"))  # Police en gras
        self.zone_de_texte.tag_configure("normal", font=("Helvetica", 12, "normal"))  # Police normale
        categories = ["Sejours: ", "Medecins: ", "Avis: ", "Prescrition: "]
        for i in range(4):
            self.zone_de_texte.insert(tk.END, f"{categories[i]} \n", "gras")
            
            for dictionnaire in (self.liste_donnees[i]):
                for cle, valeur in dictionnaire.items():
                    self.zone_de_texte.insert(tk.END, f"{cle}: ", "gras")
                    self.zone_de_texte.insert(tk.END, f"{valeur} \n", "normal")
            self.zone_de_texte.insert(tk.END, "\n")
            
# --------------------------------------------------------------------------------------------------        
           
if __name__ == "__main__":
    root = tk.Tk()
    root.title("fenêtre")
    root.resizable(width=False,height=False)
    details = Details(root, 4)
    details.recuperation_donnees(1)
    root.mainloop()
        
