# source - tableau:
# https://stackoverflow.com/questions/75294027/why-is-my-tkinter-treeview-not-changing-colors
import requests
import tkinter as tk
from tkinter import ttk
from tkinter.messagebox import showinfo

class Tableau_patients(tk.Toplevel):
    
    def __init__(self, fenetre):
        tk.Toplevel.__init__(self, fenetre) # Initialisation de la fenêtre Toplevel avec 'fenetre' comme parent.
        self.title("Students")
        self.geometry("700x400")  # Dimensions de la fenêtrefenetre_application("Fenêtre Secondaire")
        self.liste_personnes = {}
        self.id_selectionne = None  # permet de récupéer l'ID sélectionnée par cli sur la ligne
        ## Tableau Triview
        # définir les colonnes du tableau
        columns = ('id','first_name', 'surname', 'age')
        self.tree = ttk.Treeview(self, columns=columns, show='headings')
        self.tree.grid(row=0, column=0, sticky='nsew')
        # sélection d'un enregistrement
        self.tree.bind('<<TreeviewSelect>>', self.item_selected)
        self.numero_ligne=0
        
    def recuperation_donnees(self, url):

        # L'URL du serveur d'où récupérer les données JSON
        #self.url = 'http://127.0.0.1:5000/students'

        # Envoyer la requête GET
        reponse = requests.get(url)

        # Vérifier si la requête a réussi
        if reponse.status_code == 200:
            # Transformer le format json en listes
            self.liste_personnes = reponse.json()
            print(self.liste_personnes)
        else:
            print(f"Erreur lors de la récupération des données: {reponse.status_code}")
    
    def affichage_tableau(self):
            
        # style the widget
        s = ttk.Style()
        s.theme_use('clam')
        
        # define headings
        self.tree.heading('first_name', text='First_name')
        self.tree.heading('surname', text='Surname')
        self.tree.heading('age', text='Age')
        self.tree.heading('id', text='Id')
        s.configure('Treeview.Heading', background="lightblue")

        # generate sample data
        contacts = []
        i = 1
        for personne in self.liste_personnes:  # Directement itérer sur la liste des dictionnaires
            row_values = (personne['id'], personne['first_name'], personne['surname'], personne['age'])
            i += 1
            if i % 2:
                
                self.tree.insert('', tk.END, values=row_values, tags=('oddrow',))
            else:
                self.tree.insert('', tk.END, values=row_values, tags=('evenrow',))
            
    def item_selected(self, event):
        selected_items = self.tree.selection()  # Récupère la liste des éléments sélectionnés dans le Treeview.
        selected_item = selected_items[0]  # Prend uniquement le premier élément sélectionné.
        item_id = self.tree.item(selected_item, 'values')[0]  # Récupère l'ID, qui est la première valeur de l'élément sélectionné.
        print(item_id)  # Affiche l'ID de l'élément sélectionné.
        self.id_selectionne = item_id  # Stocke l'ID de l'élément sélectionné dans une variable

    def habillage_tableau(self):
       # Création et configuration de la Scrollbar
        scrollbar = ttk.Scrollbar(self, orient=tk.VERTICAL, command=self.tree.yview)
        self.tree.configure(yscroll=scrollbar.set)
        scrollbar.grid(row=0, column=1, sticky='ns')

        # style row colors
        self.tree.tag_configure('oddrow', background='lightgrey')
        self.tree.tag_configure('evenrow', background='white')

if __name__ == '__main__':       
    root = tk.Tk()
    root.title("fenêtre principale")
    root.resizable(width=False,height=False)
    tableau = Tableau_patients(root)
    tableau.recuperation_donnees('http://127.0.0.1:5000/students')
    tableau.affichage_tableau()
    tableau.habillage_tableau()
    root.mainloop()